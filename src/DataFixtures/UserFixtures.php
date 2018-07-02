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
        $user->setUsername('John')->setEmail("John123@gmail.com")->setRoles(array('ROLE_USER'))->setRegisterDate(new \DateTime())->setEnabled(1)->setPlainPassword("JohnPassword");
        $manager->persist($user);
        $manager->flush();
    }
}
