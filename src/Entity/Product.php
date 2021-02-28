<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\NumericFilter;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"product: read"}},
 *     denormalizationContext={"groups"={"product: write"}},
 *     attributes={"pagination_items_per_page"=30}
 * )
 * @ApiFilter(PropertyFilter::class)
 * @ApiFilter(RangeFilter::class, properties={"price"})
 * @ApiFilter(BooleanFilter::class, properties={"isPublic"})
 * @ApiFilter(DateFilter::class, properties={"deletedAt", "updatedAt", "createdAt"})
 * @ApiFilter(NumericFilter::class, properties={"stock"})
 * @ApiFilter(SearchFilter::class, properties={
 *          "title": "partial",
 *          "description": "partial",
 *          "status": "exact",
 *          "sku": "word_start"
 *     })
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 * @ORM\Table("`products`")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true, hardDelete=true)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"product: read", "product: write"})
     */
    private string $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"product: read", "product: write"})
     */
    private ?string $description;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"product: read", "product: write"})
     */
    private bool $isPublic = true;

    /**
     * TODO oneToOne relation to a diff table
     * @ORM\Column(type="integer")
     * @Groups({"product: read", "product: write"})
     */
    private int $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"product: read", "product: write"})
     */
    private ?string $sku;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"product: read", "product: write"})
     */
    private int $stock = 0;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"product: read", "product: write"})
     */
    private int $price = 0;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Groups({"product: read"})
     */
    private ?\DateTimeInterface $deletedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"product: read"})
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"product: read"})
     */
    private ?\DateTimeInterface $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Media::class, inversedBy="products")
     * @Groups({"product: read", "product: write"})
     */
    private $media;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     * @Groups({"product: read", "product: write"})
     */
    private $categories; /*TODO wait for stable php 8 and symfony to use union type hinting*/

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function isPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->media->contains($media)) {
            $this->media[] = $media;
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        if ($this->media->contains($media)) {
            $this->media->removeElement($media);
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }
}
