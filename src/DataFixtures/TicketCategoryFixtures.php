<?php

namespace App\DataFixtures;

use App\Entity\TicketCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TicketCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $statusFixture = [
            "open" => [
                "name" => "Question",
                "position" => "1",
            ],
            "pending" => [
                "name" => "Problem",
                "position" => "2",
            ],
            "closed" => [
                "name" => "Bug",
                "position" => "3",
            ],
            "waiting" => [
                "name" => "Suggestion",
                "position" => "4",
            ],
        ];
        foreach ($statusFixture as $name => $value) {
            $status = new TicketCategory();
            $status->setName($name)->setPosition($value['position']);
            $manager->persist($status);
        }
        $manager->flush();
    }
}
