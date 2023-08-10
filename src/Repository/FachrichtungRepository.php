<?php

namespace App\Repository;

use App\Entity\Fachrichtung;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fachrichtung>
 *
 * @method Fachrichtung|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fachrichtung|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fachrichtung[]    findAll()
 * @method Fachrichtung[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FachrichtungRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fachrichtung::class);
    }

//    /**
//     * @return Fachrichtung[] Returns an array of Fachrichtung objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Fachrichtung
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
