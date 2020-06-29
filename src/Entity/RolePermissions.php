<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RolePermissionsRepository")
 */
class RolePermissions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $roleId;

    /**
     * @ORM\Column(type="integer")
     */
    private $permissionId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    public function setRoleId(int $roleId): self
    {
        $this->roleId = $roleId;

        return $this;
    }

    public function getPermissionId(): ?int
    {
        return $this->permissionId;
    }

    public function setPermissionId(int $permissionId): self
    {
        $this->permissionId = $permissionId;

        return $this;
    }
}
