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
 *     attributes={}
 * )
 * @ApiFilter(PropertyFilter::class)
 * @ApiFilter(RangeFilter::class, properties={"originalPrice"})
 * @ApiFilter(BooleanFilter::class, properties={"isPublic"})
 * @ApiFilter(DateFilter::class, properties={"deletedAt", "updatedAt", "createdAt"})
 * @ApiFilter(NumericFilter::class, properties={"quantity"})
 * @ApiFilter(SearchFilter::class, properties={
 *          "title": "partial",
 *          "description": "partial",
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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"product: read", "product: write"})
     */
    private ?string $sku;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"product: read", "product: write"})
     */
    private int $quantity = 0;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Groups({"product: read", "product: write"})
     */
    private float $originalPrice = 0;

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
     * @ORM\ManyToMany(targetEntity=File::class, inversedBy="products")
     * @Groups({"product: read", "product: write"})
     */
    private $files;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     * @Groups({"product: read", "product: write"})
     */
    private $categories;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"product: read", "product: write"})
     */
    private int $discount = 0;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="products")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Variant::class, mappedBy="product", orphanRemoval=true)
     */
    private $variants;

    /**
     * @ORM\ManyToOne(targetEntity=LookupProductStatus::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Vendor::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vendor;

    /**
     * TODO in kg for now
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $weight;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isContinueSellingOutOfStock = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isPhysicalProduct = true;

    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->variants = new ArrayCollection();
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

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOriginalPrice(): float
    {
        return $this->originalPrice;
    }

    public function setOriginalPrice(float $originalPrice): self
    {
        $this->originalPrice = $originalPrice;

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
     * @return Collection|File[]
     */
    public function getFiles(): Collection
    {
        return $this->files;
    }

    public function addFile(File $file): self
    {
        if (!$this->files->contains($file)) {
            $this->files[] = $file;
        }

        return $this;
    }

    public function removeFile(File $file): self
    {
        if ($this->files->contains($file)) {
            $this->files->removeElement($file);
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

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    /**
     * @return Collection|Variant[]
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(Variant $variant): self
    {
        if (!$this->variants->contains($variant)) {
            $this->variants[] = $variant;
            $variant->setProduct($this);
        }

        return $this;
    }

    public function removeVariant(Variant $variant): self
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getProduct() === $this) {
                $variant->setProduct(null);
            }
        }

        return $this;
    }

    public function getStatus(): ?LookupProductStatus
    {
        return $this->status;
    }

    public function setStatus(?LookupProductStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getIsContinueSellingOutOfStock(): ?bool
    {
        return $this->isContinueSellingOutOfStock;
    }

    public function setIsContinueSellingOutOfStock(bool $isContinueSellingOutOfStock): self
    {
        $this->isContinueSellingOutOfStock = $isContinueSellingOutOfStock;

        return $this;
    }

    public function getIsPhysicalProduct(): ?bool
    {
        return $this->isPhysicalProduct;
    }

    public function setIsPhysicalProduct(bool $isPhysicalProduct): self
    {
        $this->isPhysicalProduct = $isPhysicalProduct;

        return $this;
    }
}
