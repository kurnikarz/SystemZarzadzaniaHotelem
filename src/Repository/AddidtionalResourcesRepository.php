<?php

namespace App\Repository;

use App\Entity\AddidtionalResources;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AddidtionalResources|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddidtionalResources|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddidtionalResources[]    findAll()
 * @method AddidtionalResources[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddidtionalResourcesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddidtionalResources::class);
    }

    // /**
    //  * @return AddidtionalResources[] Returns an array of AddidtionalResources objects
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
    public function findOneBySomeField($value): ?AddidtionalResources
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
