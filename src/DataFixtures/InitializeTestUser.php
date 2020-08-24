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

        $role = new Role(); //Admin
        $role->setName('Administrator');
        $role->setLabel('ROLE_ADMIN');

        foreach ($permissions as $slug => $name) {
            $permission = new Permission();
            $permission->setName($name);
            $permission->setLabel($slug);
            $manager->persist($permission);

            $role->addPermission($permission);
        }
        $manager->persist($role);

        //TODO simulate the generate of permissions per services/features eg PERMISSION_{SERVICE}_{FEATURE}_{VIEW,EDIT,CREATE,DELETE,ADD,REMOVE???}
        //TODO Create a second role with minimum permissions and add it to the test group
        $role = new Role(); //User
        $role->setName('User');
        $role->setLabel('ROLE_USER');

        foreach ($permissions as $slug => $name) {
            $permission = new Permission();
            $permission->setName($name);
            $permission->setLabel($slug);
            $manager->persist($permission);

            $role->addPermission($permission);
        }
        $manager->persist($role);

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@admin.com');
        $user->setPassword($this->passwordEncoder->encodePassword(
         $user,
        'admin'
        ));
        $user->addRoles($role);
        $manager->persist($user);

        $group = new Group();
        $group->setName('TestGroup');
        $group->setLabel('test_group');
        $group->addUser($user);
        $group->addRole();
        $manager->persist($group);

        $manager->flush();
    }
}
