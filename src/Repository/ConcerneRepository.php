<?php

namespace App\Repository;

use App\Entity\Concerne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Concerne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Concerne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Concerne[]    findAll()
 * @method Concerne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcerneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Concerne::class);
    }

    // /**
    //  * @return Concerne[] Returns an array of Concerne objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Concerne
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
