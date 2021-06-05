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
use App\Controller\File\DeleteFileAction;
use App\Dto\FileOutput;

/**
 * @ApiResource(
 *     output=FileOutput::class,
 *     normalizationContext={"skip_null_values" = false, "groups"={"file:read"}},
 *     denormalizationContext={"groups"={"file:write"}},
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
 *         "get",
 *         "delete"={
 *          "controller"=DeleteFileAction::class,
 *         }
 *     }
 * )
 * @ORM\Entity(repositoryClass=FileRepository::class)
 * @ORM\Table("`files`")
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @Groups({"file:read", "file:write"})
     */
    private UuidV4 $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"file:read", "product:read"})
     */
    private string $realName;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"file:read", "file:write", "product:read"})
     */
    private string $displayName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file:read", "product:read"})
     */
    private ?string $extension;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file:read", "product:read"})
     */
    private ?string $mimeType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"file:read", "product:read"})
     */
    private ?int $size;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"file:read", "product:read"})
     */
    private ?float $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"file:read", "product:read"})
     */
    private ?float $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file:read", "product:read"})
     */
    private ?string $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     * @Groups({"file:read", "file:write", "product:read"})
     */
    private ?string $mediaUrl;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Groups({"file:read", "product:read"})
     */
    private ?\DateTimeInterface $deletedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"file:read", "product:read"})
     */
    private ?\DateTimeInterface $updatedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"file:read", "product:read"})
     */
    private ?\DateTimeInterface $createdAt;

    private mixed $uploadedFile = null;

    /**
     * @ORM\ManyToOne(targetEntity=LookupFileStatus::class, inversedBy="files")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @Groups({"file:read", "product:read"})
     */
    private ?string $url = null;

    /**
     * @ORM\OneToMany(targetEntity=ProductFile::class, mappedBy="files", cascade={"persist", "remove"})
     */
    private $productFiles;

    const ACCEPTED_MIME_TYPES = [
        'images' => [
            'jpg' => 'image/jpg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
            'webp' => 'image/webp',
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

    public function __construct(UuidV4 $id = null)
    {
        $this->id = $id ?: UuidV4::v4();
        $this->productFiles = new ArrayCollection();
    }

    public function getId(): UuidV4
    {
        return $this->id;
    }

    public function getRealName(): string
    {
        return $this->realName;
    }

    public function setRealName(string $realName): self
    {
        $this->realName = $realName;

        return $this;
    }

    public function getDisplayName(): string
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

    public function setUploadedFile(mixed $uploadedFile): self
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }

    public function getUploadedFile(): mixed
    {
        return $this->uploadedFile;
    }

    public function getStatus(): ?LookupFileStatus
    {
        return $this->status;
    }

    public function setStatus(?LookupFileStatus $status): self
    {
        //TODO on creation set to default
        $this->status = $status;

        return $this;
    }

    public function getFullDisplayName(): string
    {
        return $this->displayName . '.' . $this->extension;
    }

    public function getFullRealName(): string
    {
        return $this->realName . '.' . $this->extension;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|ProductFile[]
     */
    public function getProductFiles(): Collection
    {
        return $this->productFiles;
    }

    public function addProductFile(ProductFile $productFile): self
    {
        if (!$this->productFiles->contains($productFile)) {
            $this->productFiles[] = $productFile;
            $productFile->setFiles($this);
        }

        return $this;
    }

    public function removeProductFile(ProductFile $productFile): self
    {
        if ($this->productFiles->removeElement($productFile)) {
            // set the owning side to null (unless already changed)
            if ($productFile->getFiles() === $this) {
                $productFile->setFiles(null);
            }
        }

        return $this;
    }
}
