<?php

namespace App\Repository;

use App\Entity\TicketStatus;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Maps_red\TicketingBundle\Repository\TicketStatusRepository as BaseTicketRepository;

/**
 * @method TicketStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketStatus[]    findAll()
 * @method TicketStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketStatusRepository extends BaseTicketRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TicketStatus::class);
    }

}
