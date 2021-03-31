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

    public static function isUrl(string $url): bool
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }

        return false;
    }

    //replace multiple slashes with only 1
    public static function deslash(string $string): string
    {
        return preg_replace('~(^|[^:])//+~', '\\1/', $string);
    }
}