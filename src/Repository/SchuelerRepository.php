<?php

namespace App\Repository;

use App\Controller\SchuelerController;
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
//     * @return SchuelerController[] Returns an array of SchuelerController objects
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

//    public function findOneBySomeField($value): ?SchuelerController
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
    public function findbyfachrichtung($value): array
    {
        $queryBuilder = $this->createQueryBuilder('v')
            ->orderBy('v.Nachname');

        if ($value) {
            $queryBuilder->andWhere('v.fachrichtung = :val')
                ->setParameter('val', $value);
        }


//         ->andWhere('v.fachrichtung = :val' )
//         ->setParameter('val', $value)


        return $queryBuilder
            ->getQuery()
            ->getResult();
    }

//    }
}
