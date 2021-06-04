<?php


namespace App\Dto;


use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\UuidV4;

final class FileOutput
{
    /**
     * @Groups({"file:read", "product:read"})
     */
    public UuidV4 $id;

    /**
     * @Groups({"file:read", "product:read"})
    */
    public ?string $url;

    /**
     * @Groups({"file:read", "product:read"})
     */
    public string $realName;

    /**
     * @Groups({"file:read", "file:write", "product:read"})
     */
    public string $displayName;

    /**
     * @Groups({"file:read", "product:read"})
     */
    public ?string $extension;

    /**
     * @Groups({"file:read", "product:read"})
     */
    public string $fullRealName;

    /**
     * @Groups({"file:read", "product:read"})
     */
    public string $fullDisplayName;

    /**
     * @Groups({"file:read", "product:read"})
     */
    public ?int $size;

    /**
     * @Groups({"file:read", "product:read"})
     */
    public ?string $mimeType;
}