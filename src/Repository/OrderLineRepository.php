<?php

namespace App\Repository;

use App\Entity\OrderLine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderLine|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderLine|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderLine[]    findAll()
 * @method OrderLine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderLineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderLine::class);
    }

    /**
     * @method mixed findWithProduct
     */
    public function findWithProduct($id)
    {
        $qb = $this->createQueryBuilder('l')
            ->select('l.quantity as orderline_quantity, l.total as orderline_total, p.id as product_id, p.title as product_title, p.price as product_price')
            ->join('l.product', 'p')
            ->leftJoin('l.customerOrder', 'o')
            ->where('l.customerOrder = :id')
            ->setParameter('id', $id);

        $query = $qb->getQuery();

        return $query->execute();
    }

    /*
    public function findOneBySomeField($value): ?OrderLine
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
