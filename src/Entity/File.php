<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\UuidV4;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\File\CreateFileAction;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"file: read"}},
 *     denormalizationContext={"groups"={"file: write"}},
 *     attributes={},
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateFileAction::class,
 *             "deserialize"=false,
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                      "id"={
 *                                         "type"="uuid"
 *                                     },
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *         },
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @ORM\Entity(repositoryClass=FileRepository::class)
 * @ORM\Table("`files`")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=true, hardDelete=true)
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @Groups({"file: read", "file: write"})
     */
    private UuidV4 $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"file: read", "file: write"})
     */
    private string $originalName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"file: read"})
     */
    private string $displayName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file: read"})
     */
    private ?string $extension;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file: read"})
     */
    private ?string $mimeType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"file: read"})
     */
    private ?int $size;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"file: read"})
     */
    private ?float $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"file: read"})
     */
    private ?float $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file: read"})
     */
    private ?string $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     * @Groups({"file: read"})
     */
    private ?string $mediaUrl;

    /**
     * @TODO consider moving this to a status lookup table, a file can have different statuses
     * @ORM\Column(type="boolean")
     */
    private bool $isProcessed = false;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Groups({"file: read"})
     */
    private ?\DateTimeInterface $deletedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"file: read"})
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"file: read"})
     */
    private ?\DateTimeInterface $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="files")
     */
    private $products;

    /**
     * TODO maybe save the uploadedFile here during saving, to use its props
     */
    private mixed $uploadedFile;

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

    public function __construct(UuidV4 $uuidV4)
    {
        $this->products = new ArrayCollection();
        $this->id = $uuidV4 ?: UuidV4::v4();
    }

    public function getId(): UuidV4
    {
        return $this->id;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function setDisplayName(string $displayName): self
    {
        $this->displayName = $displayName;

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

    public function setFile(mixed $uploadedFile): self
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }

    public function getUploadedFile(): mixed
    {
        return $this->uploadedFile;
    }

}
