<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UsersRepository extends ServiceEntityRepository
{

    public function getList(): array
    {
        $query = $this->createQueryBuilder('u')->select(['u.name','u.surname'])->getQuery();
        
        return $query->getResult();
         
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }
}