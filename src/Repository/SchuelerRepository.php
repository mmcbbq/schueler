<?php

namespace App\Repository;

use App\Entity\Schueler;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Schueler>
 *
 * @method Schueler|null find($id, $lockMode = null, $lockVersion = null)
 * @method Schueler|null findOneBy(array $criteria, array $orderBy = null)
 * @method Schueler[]    findAll()
 * @method Schueler[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchuelerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Schueler::class);
    }

//    /**
//     * @return Schueler[] Returns an array of Schueler objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Schueler
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
