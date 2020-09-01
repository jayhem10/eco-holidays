<?php

namespace App\Repository;

use App\Entity\ImageUpdate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageUpdate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageUpdate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageUpdate[]    findAll()
 * @method ImageUpdate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageUpdateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageUpdate::class);
    }

    // /**
    //  * @return ImageUpdate[] Returns an array of ImageUpdate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageUpdate
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
