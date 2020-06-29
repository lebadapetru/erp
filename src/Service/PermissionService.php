<?php


namespace App\Service;


class PermissionService
{
    const READ = 'read';
    const WRITE = 'write';
    const DELETE = 'delete';

    public $permissions = [
        self::READ,
        self::WRITE,
        self::DELETE
    ];

    public function __construct()
    {
    }
}