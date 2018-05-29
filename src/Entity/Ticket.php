<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 29/05/2018
 * Time: 22:03
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Maps_red\TicketingBundle\Entity\Ticket as BaseTicket;

/**
 * @ORM\Table(name="ticket_tickets")
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket extends BaseTicket
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}