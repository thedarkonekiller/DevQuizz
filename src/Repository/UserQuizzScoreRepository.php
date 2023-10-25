<?php

namespace App\Repository;

use App\Entity\UserQuizzScore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserQuizzScore>
 *
 * @method UserQuizzScore|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserQuizzScore|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserQuizzScore[]    findAll()
 * @method UserQuizzScore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserQuizzScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserQuizzScore::class);
    }

//    /**
//     * @return UserQuizzScore[] Returns an array of UserQuizzScore objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserQuizzScore
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
