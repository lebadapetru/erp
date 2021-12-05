<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoriesRepository;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\UuidV4;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"category:read"}},
 *     denormalizationContext={"groups"={"category:write"}},
 *     attributes={}
 * )
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 * @ORM\Table("`categories`")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @Groups({"category:read"})
     */
    private UuidV4 $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"category:read", "category:write", "product:read"})
     */
    private string $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"category:read", "category:write"})
     */
    private ?string $description;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"category:read", "category:write"})
     */
    private bool $isPublic = true;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Groups({"category:read"})
     */
    private ?\DateTimeInterface $deletedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"category:read"})
     */
    private \DateTimeInterface $updatedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"category:read"})
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="categories")
     * @Groups({"category:read", "category:write"})
     */
    private $products;

    public function __construct(UuidV4 $id = null)
    {
        $this->id = $id ?: UuidV4::v4();
        $this->products = new ArrayCollection();
    }

    public function getId(): UuidV4
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeInterface
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeInterface $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addCategory($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeCategory($this);
        }

        return $this;
    }

    /**
     * @Groups({"category:read"})
    */
    public function getUpdatedAtForHumans(): string
    {
        return Carbon::instance($this->createdAt)->format('Y M d, g:i a');
    }

    /**
     * @Groups({"category:read"})
     */
    public function getCreatedAtForHumans(): string
    {
        return Carbon::instance($this->createdAt)->format('Y M d, g:i a');
    }
}
