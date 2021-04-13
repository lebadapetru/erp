<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VariantRepository::class)
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true, hardDelete=true)
 * @ORM\Table("`variants`")
 */
class Variant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?float $originalPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $discount;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?\DateTimeInterface $deletedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=VariantValue::class, inversedBy="variants")
     */
    private $variantValues;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="variants")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    public function __construct()
    {
        $this->variantValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getOriginalPrice(): ?float
    {
        return $this->originalPrice;
    }

    public function setOriginalPrice(?float $originalPrice): self
    {
        $this->originalPrice = $originalPrice;

        return $this;
    }

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(?int $discount): self
    {
        $this->discount = $discount;

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
     * @return Collection|VariantValue[]
     */
    public function getVariantValues(): Collection
    {
        return $this->variantValues;
    }

    public function addVariantValue(VariantValue $variantValue): self
    {
        if (!$this->variantValues->contains($variantValue)) {
            $this->variantValues[] = $variantValue;
        }

        return $this;
    }

    public function removeVariantValue(VariantValue $variantValue): self
    {
        $this->variantValues->removeElement($variantValue);

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
