<?php


namespace App\Dto;


use Symfony\Component\Serializer\Annotation\Groups;

final class FileOutput
{
    /**
     * @Groups({"file:read", "product:read"})
    */
    public ?string $url;

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }
}