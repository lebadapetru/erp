<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FileRepository;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FileRepository::class)
 * @ORM\Table("`files`")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true, hardDelete=true)
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $extension;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $mimeType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $size;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     */
    private ?string $mediaUrl;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isProcessed = false;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
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
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="file")
     */
    private $products;

    const ACCEPTED_MIME_TYPES = [
        'images' => [
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/svg+xml',
            'image/webp',
        ],
        'videos' => [
            'video/mp4',
            'video/quicktime'
        ],
    ];

    const ACCEPTED_EXTENSIONS = [
        'images' => [
            'jpg',
            'jpeg',
            'png',
            'gif',
            'svg',
            'webp'
        ],
        'videos' => [
            'mp4',
            'mov',
        ],
    ];

    public function __construct()
    {
        $this->products = new ArrayCollection();
        /*TODO until it gets fixed*/
        $this->setUpdatedAt(Carbon::now());
        $this->setCreatedAt(Carbon::now());
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

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

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
            $product->addFile($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->removeFile($this);
        }

        return $this;
    }

    public function getMediaUrl(): ?string
    {
        return $this->mediaUrl;
    }

    public function setMediaUrl(?string $mediaUrl): self
    {
        $this->mediaUrl = $mediaUrl;

        return $this;
    }

    public function isVideo(): bool
    {
        if (str_contains($this->mimeType, 'video/')) {
            return true;
        }

        return false;
    }

    public function isImage(): bool
    {
        if (str_contains($this->mimeType, 'image/')) {
            return true;
        }

        return false;
    }

    public function isMediaUrl(): bool
    {
        if (!$this->mimeType && filter_var($this->mediaUrl, FILTER_VALIDATE_URL)) {
            return true;
        }

        return false;
    }

    public function isProcessed(): bool
    {
        return $this->isProcessed;
    }

    public function setIsProcessed(bool $isProcessed): self
    {
        $this->isProcessed = $isProcessed;

        return $this;
    }
}
