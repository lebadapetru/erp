<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\VariantOptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=VariantOptionRepository::class)
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true, hardDelete=true)
 * @ORM\Table("`variant_options`")
 */
class VariantOption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

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
     * @ORM\OneToMany(targetEntity=VariantValue::class, mappedBy="variantOption", orphanRemoval=true)
     */
    private $variantValues;

    public function __construct()
    {
        $this->variantValues = new ArrayCollection();
    }

    public function getId(): ?int
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
            $variantValue->setVariantOption($this);
        }

        return $this;
    }

    public function removeVariantValue(VariantValue $variantValue): self
    {
        if ($this->variantValues->removeElement($variantValue)) {
            // set the owning side to null (unless already changed)
            if ($variantValue->getVariantOption() === $this) {
                $variantValue->setVariantOption(null);
            }
        }

        return $this;
    }
}
