<?php


namespace App\Service;


class Helpers
{
    public static function isVideo(string $mimeType): bool
    {
        /*TODO replace with str_contains in php8*/
        if (strpos($mimeType, 'video/') !== false) {
            return true;
        }

        return false;
    }

    public static function isImage(string $mimeType): bool
    {
        /*TODO replace with str_contains in php8*/
        if (strpos($mimeType, 'image/') !== false) {
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