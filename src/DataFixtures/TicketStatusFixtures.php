<?php

namespace App\DataFixtures;

use App\Entity\TicketStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TicketStatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $status = new TicketStatus();
         $status->setName('open')->setValue('Ouvert')->setStyle('success');
         $manager->persist($status);

        $manager->flush();
    }
}
