<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 29/05/2018
 * Time: 22:03
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Maps_red\TicketingBundle\Entity\TicketKeyword as BaseTicketKeyword;

/**
 * @ORM\Table(name="ticket_tickets_keyword")
 * @ORM\Entity(repositoryClass="App\Repository\TicketKeywordRepository")
 */
class TicketKeyword extends BaseTicketKeyword
{

}