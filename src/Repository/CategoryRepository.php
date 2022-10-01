<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Intl\Locale;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function add(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Category $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getCategoryBySlug($slug){

        return $this->createQueryBuilder('r')
            ->innerJoin('r.translations',  'rt' )
            ->andWhere('r.isActive = :active AND rt.slug = :slug')    
            ->setParameter('active', true)
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;

    }

    public function getChoices(){
        //Locale::getDefault()
        $arr_result = [];
        $arr_rows =  $this->createQueryBuilder('r')
            ->select('r.id as r_id, r.orderRow as r_order_row, rt.name as r_name' )
            ->innerJoin('r.translations',  'rt' )
            ->andWhere('r.isActive = :active AND rt.locale = :language')    
            ->setParameter('active', true)
            ->setParameter('language', Locale::getDefault())
            ->getQuery()->getResult()
        ;
 
        foreach($arr_rows as $key => $row) $arr_result[$row['r_id']] = ucfirst($row['r_name']);

        return $arr_result;
    }




//    /**
//     * @return Category[] Returns an array of Category objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
