<?php

namespace App\Entity;

use App\Repository\ProductFileRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass=ProductFileRepository::class)
 */
class ProductFile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productFiles")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=File::class, inversedBy="productFiles")
     * @Groups("product:read", "product:write")
     * @SerializedName("file")
     */
    private $files;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("product:read", "product:write")
     */
    private ?int $position;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups("product:read")
     */
    private \DateTimeInterface $addedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducts(): ?Product
    {
        return $this->products;
    }

    public function setProducts(?Product $products): self
    {
        $this->products = $products;

        return $this;
    }

    public function getFiles(): ?File
    {
        return $this->files;
    }

    public function setFiles(?File $files): self
    {
        $this->files = $files;

        return $this;
    }


    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeInterface $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }

}
