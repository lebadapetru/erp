<?php

namespace App\Dao;

use App\Entity\File;
use Doctrine\ORM\EntityManagerInterface;

class FileDao
{
    const COL_REAL_NAME    = 'real_name';
    const COL_DISPLAY_NAME = 'display_name';
    const COL_EXTENSION    = 'extension';
    const COL_MIME_TYPE    = 'mime_type';
    const COL_SIZE         = 'size';
    const COL_WIDTH        = 'width';
    const COL_HEIGHT       = 'height';
    const COL_PATH         = 'path';
    const COL_MEDIA_URL    = 'media_url';
    const COL_STATUS       = 'status';
    const COL_DELETED_AT   = 'deleted_at';
    const COL_UPDATED_AT   = 'updated_at';
    const COL_CREATED_AT   = 'created_at';

    const COLUMNS = [
        self::COL_REAL_NAME,
        self::COL_DISPLAY_NAME,
        self::COL_EXTENSION,
        self::COL_MIME_TYPE,
        self::COL_SIZE,
        self::COL_WIDTH,
        self::COL_HEIGHT,
        self::COL_PATH,
        self::COL_MEDIA_URL,
        self::COL_STATUS,
        self::COL_DELETED_AT,
        self::COL_UPDATED_AT,
        self::COL_CREATED_AT,
    ];

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function createFile(array $params): File
    {
        $fileEntity = new File();
        $this->updateFile($fileEntity, $params);

        return $fileEntity;
    }

    public function updateFile(File $fileEntity, array $params): File
    {
        //TODO abstract class
        foreach ($params as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));
            $fileEntity->{$method}($value);
        }

        $this->entityManager->persist($fileEntity);
        $this->entityManager->flush();

        return $fileEntity;
    }
}