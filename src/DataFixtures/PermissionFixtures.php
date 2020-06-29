<?php

namespace App\DataFixtures;

use App\Entity\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PermissionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $permissions = [
          'read',
          'write',
          'delete',
        ];

        foreach ($permissions as $permission) {
            $permissionEntity = new Permission();
            $permissionEntity->setName($permission);
            $manager->persist($permissionEntity);
        }
        $manager->flush();

    }
}
