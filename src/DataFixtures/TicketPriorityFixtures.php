<?php

namespace App\DataFixtures;

use App\Entity\TicketPriority;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TicketPriorityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $statusFixture = [
            "open" => [
                "name" => "low",
                "value" => "low",
            ],
            "pending" => [
                "name" => "medium",
                "value" => "medium",
            ],
            "closed" => [
                "name" => "high",
                "value" => "high",
            ],
            "waiting" => [
                "name" => "critical",
                "value" => "critical",
            ],
        ];
        foreach ($statusFixture as $name => $value) {
            $status = new TicketPriority();
            $status->setName($name)->setValue($value['value']);
            $manager->persist($status);
        }
        $manager->flush();
    }
}
