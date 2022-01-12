<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TagRepository;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\UuidV4;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"tag:read"}},
 *     denormalizationContext={"groups"={"tag:write"}},
 *     attributes={}
 * )
 * @ORM\Entity(repositoryClass=TagRepository::class)
 * @ORM\Table("`tags`")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true, hardDelete=true)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @Groups({"tag:read"})
     */
    private UuidV4 $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tag:read", "tag:write"})
     */
    private string $name;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Groups({"tag:read"})
     */
    private ?\DateTimeInterface $deletedAt = null;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"tag:read"})
     */
    private \DateTimeInterface $updatedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"tag:read"})
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="tags")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $product->addTag($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeTag($this);
        }

        return $this;
    }

    /**
     * @Groups({"tag:read"})
     */
    public function getUpdatedAtForHumans(): string
    {
        return Carbon::instance($this->createdAt)->format('Y M d, g:i a');
    }

    /**
     * @Groups({"tag:read"})
     */
    public function getCreatedAtForHumans(): string
    {
        return Carbon::instance($this->createdAt)->format('Y M d, g:i a');
    }
}
