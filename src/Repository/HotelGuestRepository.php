<?php

namespace App\Repository;

use App\Entity\HotelGuest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HotelGuest|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelGuest|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelGuest[]    findAll()
 * @method HotelGuest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelGuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelGuest::class);
    }

    // /**
    //  * @return HotelGuest[] Returns an array of HotelGuest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HotelGuest
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
