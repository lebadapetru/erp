<?php

namespace App\DataFixtures;

use App\Entity\Feature;
use App\Entity\Group;
use App\Entity\Permission;
use App\Entity\Role;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InitializeTestUser extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    //this is a simulation of the object i receive after a READ request to the Services HQ API
    //to check what services are available atm and then make a call to each service to initiate/configure it for the client
    //if he has a subscription for it
    const SERVICES = [
        'general' => [
            'name' => 'General',
            'label' => 'SERVICE_GENERAL',
            'active' => true, //true if the subscription is active, false otherwise
            'purchased_at' => '#', //timestamp when subs was bought for this service
            'endpoint' => '#', //endpoint to call for the configuring process to start
            'stage' => 'alpha', //in case some services can be released even if the work isnt finished, take additional cautions
            //the services&features and thier properties micro service should be developed in the early phase
            //to unblock the work needed on other sections of the app
            'features' => [
                //at first it wont be needed a subs system on feature level,
                //most feature props are alike the services ones
                'permissions' => [
                    'name' => 'Permissions',
                    'label' => 'FEATURE_PERMISSIONS',
                    'permissions' => [
                        'add' => [
                            'name' => 'Add',
                            'label' => 'PERMISSION_ADD',

                        ],
                        'remove' => [
                            'name' => 'Remove',
                            'label' => 'PERMISSION_REMOVE',

                        ],
                        'edit' => [
                            'name' => 'Edit',
                            'label' => 'PERMISSION_EDIT',

                        ],
                        'view' => [
                            'name' => 'View',
                            'label' => 'PERMISSION_VIEW',
                        ],
                    ],
                    'feature' => [] //can features have child features? maybe in the future
                ],
                'roles' => [
                    'name' => 'Roles',
                    'label' => 'FEATURE_ROLES',
                    'permissions' => [
                        'add' => [
                            'name' => 'Add',
                            'label' => 'PERMISSION_ADD',

                        ],
                        'remove' => [
                            'name' => 'Remove',
                            'label' => 'PERMISSION_REMOVE',

                        ],
                        'create' => [
                            'name' => 'Create',
                            'label' => 'PERMISSION_CREATE',

                        ],
                        'delete' => [
                            'name' => 'Delete',
                            'label' => 'PERMISSION_DELETE',

                        ],
                        'edit' => [
                            'name' => 'Edit',
                            'label' => 'PERMISSION_EDIT',

                        ],
                        'view' => [
                            'name' => 'View',
                            'label' => 'PERMISSION_VIEW',
                        ],
                    ],
                ],
                'users' => [
                    'name' => 'Users',
                    'label' => 'FEATURE_USERS',
                    'permissions' => [
                        'add' => [
                            'name' => 'Add',
                            'label' => 'PERMISSION_ADD',

                        ],
                        'remove' => [
                            'name' => 'Remove',
                            'label' => 'PERMISSION_REMOVE',

                        ],
                        'create' => [
                            'name' => 'Create',
                            'label' => 'PERMISSION_CREATE',

                        ],
                        'delete' => [
                            'name' => 'Delete',
                            'label' => 'PERMISSION_DELETE',

                        ],
                        'edit' => [
                            'name' => 'Edit',
                            'label' => 'PERMISSION_EDIT',

                        ],
                        'view' => [
                            'name' => 'View',
                            'label' => 'PERMISSION_VIEW',
                        ],
                    ],
                ],
                'groups' => [
                    'name' => 'Groups',
                    'label' => 'FEATURE_GROUPS',
                    'permissions' => [
                        'add' => [
                            'name' => 'Add',
                            'label' => 'PERMISSION_ADD',

                        ],
                        'remove' => [
                            'name' => 'Remove',
                            'label' => 'PERMISSION_REMOVE',

                        ],
                        'create' => [
                            'name' => 'Create',
                            'label' => 'PERMISSION_CREATE',

                        ],
                        'delete' => [
                            'name' => 'Delete',
                            'label' => 'PERMISSION_DELETE',

                        ],
                        'edit' => [
                            'name' => 'Edit',
                            'label' => 'PERMISSION_EDIT',

                        ],
                        'view' => [
                            'name' => 'View',
                            'label' => 'PERMISSION_VIEW',
                        ],
                    ],
                ],
            ],
        ]
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $permissionsCache = [];

        $roleEntity = new Role(); //Admin
        $roleEntity->setName('Administrator');
        $roleEntity->setLabel('ROLE_ADMIN');

        foreach (self::SERVICES as $SERVICE) {
            $serviceEntity = new Service();
            $serviceEntity->setName($SERVICE['name']);
            $serviceEntity->setLabel($SERVICE['label']);
            $serviceEntity->setIsActive($SERVICE['active']);
            foreach ($SERVICE['features'] as $FEATURE) {
                $featureEntity = new Feature();
                $featureEntity->setName($FEATURE['name']);
                $featureEntity->setLabel($FEATURE['label']);
                $serviceEntity->addFeature($featureEntity);
                $manager->persist($featureEntity);

                foreach ($FEATURE['permissions'] as $PERMISSION) {
                    $permissionEntity = $manager->getRepository(Feature::class)->findOneBy(['label' => $FEATURE['label']]);
                    $permissionEntity = (!$permissionEntity && array_key_exists($PERMISSION['label'], $permissionsCache)) ?
                        $permissionsCache[$PERMISSION['label']] : null;
                    if (!$permissionEntity) {
                        $permissionEntity = new Permission();
                        $permissionEntity->setName($PERMISSION['name']);
                        $permissionEntity->setLabel($PERMISSION['label']);
                        $manager->persist($permissionEntity);

                        $permissionsCache[$PERMISSION['label']] = $permissionEntity;
                    }

                    $roleEntity->addPermission($permissionEntity);
                }
            }

            $manager->persist($serviceEntity);
        }

        $manager->persist($roleEntity);

        $userEntity = new User();
        $userEntity->setUsername('Administrator');
        $userEntity->setEmail('admin@admin.com');
        $userEntity->setPassword($this->passwordEncoder->encodePassword(
            $userEntity,
            'admin'
        ));
        $userEntity->addRoles($roleEntity);
        $manager->persist($userEntity);

        $groupEntity = new Group();
        $groupEntity->setName('The Administrators Group');
        $groupEntity->setLabel('GROUP_ADMIN');
        $groupEntity->addUser($userEntity);
        $manager->persist($groupEntity);

        $manager->flush();


        $userRoleEntity = new Role();
        $userRoleEntity->setName('User');
        $userRoleEntity->setLabel('ROLE_USER');
        $manager->persist($userRoleEntity);

        $testRoleEntity = new Role();
        $testRoleEntity->setName('Test');
        $testRoleEntity->setLabel('ROLE_TEST');
        $manager->persist($testRoleEntity);

        $userEntity = new User(); //User can only login and have limited permissions based on roles and groups
        $userEntity->setUsername('User');
        $userEntity->setEmail('user@user.com');
        $userEntity->setPassword($this->passwordEncoder->encodePassword(
            $userEntity,
            'user'
        ));
        $userEntity->addRoles($userRoleEntity);
        $manager->persist($userEntity);

        $userGroupEntity = new Group();
        $userGroupEntity->setName('The Users Group');
        $userGroupEntity->setLabel('GROUP_USER');
        $userGroupEntity->addUser($userEntity);
        $userGroupEntity->addRole($testRoleEntity);
        $manager->persist($userGroupEntity);

        $manager->flush();
    }
}
