<?php

namespace App\Repository;

use App\Entity\Fachrichtung;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
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
    private $entityManager;
    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)

    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Fachrichtung::class);
    }


    public function getrandom():Fachrichtung
    {
        $array =$this->entityManager->getRepository(Fachrichtung::class)->findAll();
        shuffle($array);
        return $array[0];
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
