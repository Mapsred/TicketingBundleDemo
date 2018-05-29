<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\TicketStatus;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TicketStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketStatus[]    findAll()
 * @method TicketStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TicketStatus::class);
    }

}
