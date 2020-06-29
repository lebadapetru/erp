<?php


namespace App\Service;


class RoleService
{
    const ADMIN = 'admin';
    const USER = 'user';

    public $roles = [
        self::ADMIN,
        self::USER
    ];

    public function __construct()
    {
    }
}