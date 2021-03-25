<?php


namespace App\Service;


class Helpers
{
    public static function isVideo(string $mimeType): bool
    {
        if (str_contains($mimeType, 'video/')) {
            return true;
        }

        return false;
    }

    public static function isImage(string $mimeType): bool
    {
        if (str_contains($mimeType, 'image/')) {
            return true;
        }

        return false;
    }

    public static function isMediaUrl(string $mediaUrl): bool
    {
        if (filter_var($mediaUrl, FILTER_VALIDATE_URL)) {
            return true;
        }

        return false;
    }
}