<?php
/**
 * Created by PhpStorm.
 * User: Maps_red
 * Date: 29/05/2018
 * Time: 22:03
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Maps_red\TicketingBundle\Entity\TicketComment as BaseTicketComment;

/**
 * @ORM\Table(name="ticket_tickets_comment")
 * @ORM\Entity(repositoryClass="App\Repository\TicketCommentRepository")
 */
class TicketComment extends BaseTicketComment
{
    
}