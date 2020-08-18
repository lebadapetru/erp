<?php

namespace App\DataFixtures;

use App\Entity\Group;
use App\Entity\Permission;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InitializeTestUser extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $permissions = [
            'create' => 'Create',
            'read' => 'Read',
            'update' => 'Update',
            'delete' => 'Delete',
        ];

        $role = new Role();
        $role->setName('Administrator');
        $role->setSlug('ROLE_ADMIN');

        foreach ($permissions as $slug => $name) {
            $permission = new Permission();
            $permission->setName($name);
            $permission->setSlug($slug);
            $manager->persist($permission);

            $role->addPermission($permission);
        }
        $manager->persist($role);

        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@test.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
         $user,
        'test'
        ));
        $user->addRoles($role);
        $manager->persist($user);

        $group = new Group();
        $group->setName('TestGroup');
        $group->setSlug('test_group');
        $group->addUser($user);
        $manager->persist($group);

        $manager->flush();
    }
}
