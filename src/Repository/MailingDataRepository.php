<?php

namespace App\Repository;

use App\Entity\MailingData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MailingData|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailingData|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailingData[]    findAll()
 * @method MailingData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailingDataRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, MailingData::class);
    }

    public function getRandomElement() {
        $qb = $this->createQueryBuilder($_SERVER['DATABASE_NAME']);
        $countElements = $qb
            ->select('count(' . $_SERVER['DATABASE_NAME'] . '.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $qbRandom = $this->createQueryBuilder('p');
        $resRandom = $qbRandom;
        
        $queryRandom = $resRandom->getQuery();

        return $queryRandom->setFirstResult(random_int(0, $countElements-1))->setMaxResults(1)->getOneOrNullResult();
    }

    // /**
    //  * @return MailingData[] Returns an array of MailingData objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('m')
      ->andWhere('m.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('m.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?MailingData
      {
      return $this->createQueryBuilder('m')
      ->andWhere('m.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
