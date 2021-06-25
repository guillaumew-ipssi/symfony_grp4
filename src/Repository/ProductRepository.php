<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @method Product[] findByTitle(string $title) 
     */
    public function findByTitle($title)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.title LIKE :title')
            ->setParameter('title', '%'.$title.'%');

        $query = $qb->getQuery();

        return $query->execute();
    }

    /**
     * @method void updateQuantity(int $id, int $quantity)
     * 
     */
    public function updateQuantity($id, $quantity)
    {
        $qb = $this->createQueryBuilder('p')
                ->update()
                ->set('p.quantity', ':quantity')
                ->andWhere('p.id LIKE :id')
                ->setParameter('quantity', $quantity)
                ->setParameter('id', $id);

        $query = $qb->getQuery();

        return $query->execute();
    }
    
}
