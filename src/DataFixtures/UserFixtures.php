<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('John');

        $password = "JohnPassword";
        $user->setPlainPassword($password);

        $user->setEmail("John123@gmail.com");

        $roles[] = 'ROLE_USER';
        $user->setRoles($roles);

        $user->setRegisterDate($this->date = new \DateTime());

        $user->setEnabled(1);

        $manager->persist($user);
        $manager->flush();
    }
}
