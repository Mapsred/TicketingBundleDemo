<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Entity\TicketKeyword;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TicketKeyword|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketKeyword|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketKeyword[]    findAll()
 * @method TicketKeyword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketKeywordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TicketKeyword::class);
    }
}
