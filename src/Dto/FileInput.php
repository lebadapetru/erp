<?php


namespace App\Dto;

use Symfony\Component\Serializer\Annotation\Groups;

final class FileInput
{
    /**
     * @Groups({"file: write"})
    */
    public mixed $file;
}