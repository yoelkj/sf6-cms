<?php

namespace App\Repository;

use App\Entity\GalleryImagesTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GalleryImagesTranslation>
 *
 * @method GalleryImagesTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method GalleryImagesTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method GalleryImagesTranslation[]    findAll()
 * @method GalleryImagesTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GalleryImagesTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GalleryImagesTranslation::class);
    }

    public function add(GalleryImagesTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GalleryImagesTranslation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GalleryImagesTranslation[] Returns an array of GalleryImagesTranslation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GalleryImagesTranslation
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
