<?php


namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

final class FileOutput
{
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Groups({"file: read"})
     */
    public string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file: read"})
     */
    public ?string $extension;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file: read"})
     */
    public ?string $mimeType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"file: read"})
     */
    public ?int $size;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"file: read"})
     */
    public ?float $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"file: read"})
     */
    public ?float $height;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"file: read"})
     */
    public ?string $path;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url()
     * @Groups({"file: read"})
     */
    public ?string $mediaUrl;

    /**
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     * @Groups({"file: read"})
     */
    public ?\DateTimeInterface $deletedAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Groups({"file: read"})
     */
    public ?\DateTimeInterface $updatedAt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Groups({"file: read"})
     */
    public ?\DateTimeInterface $createdAt;
}