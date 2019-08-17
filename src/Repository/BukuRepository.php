<?php

namespace App\Repository;

use App\Entity\Buku;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Buku|null find($id, $lockMode = null, $lockVersion = null)
 * @method Buku|null findOneBy(array $criteria, array $orderBy = null)
 * @method Buku[]    findAll()
 * @method Buku[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BukuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Buku::class);
    }

    // /**
    //  * @return Buku[] Returns an array of Buku objects
    //  */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Buku
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
