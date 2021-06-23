<?php

namespace App\Repository;

use App\Entity\Adopt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adopt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adopt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adopt[]    findAll()
 * @method Adopt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdoptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adopt::class);
    }

    // /**
    //  * @return Adopt[] Returns an array of Adopt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Adopt
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
