<?php

namespace App\Repository;

use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Intl\Locale;

/**
 * @extends ServiceEntityRepository<Page>
 *
 * @method Page|null find($id, $lockMode = null, $lockVersion = null)
 * @method Page|null findOneBy(array $criteria, array $orderBy = null)
 * @method Page[]    findAll()
 * @method Page[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends ServiceEntityRepository
{

    static public $arr_positions = array(
        1 => 'Carousel', //Customer
        2 => 'Top', //Commercial
        3 => 'Side', //Commercial
        4 => 'content', //Commercial
    );

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Page::class);
    }

    public function getAboutPages() {
        return [];//self::$arr_about_pages;
    }

    public function getPageBySlug($slug){

        return $this->createQueryBuilder('p')
            ->innerJoin('p.translations',  'pt' )
            ->andWhere('p.isActive = :active AND pt.slug = :slug')    
            ->setParameter('active', true)
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;

    }

    public function add(Page $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Page $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getData($params = [], $only_query = false)
    {
        $qb = $this->createQueryBuilder('r')
            ->where('r.isActive = :active');

        if(isset($params["q"])){
            if(trim($params["q"]) != ''){
                $qb->innerJoin('r.translations', 'rt')
                    ->andWhere('(rt.name LIKE :term OR rt.body LIKE :term) AND rt.locale = :language')
                    ->setParameter('term', '%'.$params["q"].'%')
                    ->setParameter('language', Locale::getDefault());
            }else{
                return null;
            }
        }

       
        $qb->setParameter('active', true)
        ->orderBy('r.orderRow', 'ASC')
        ;

        
        if($only_query){
            return $qb;
        }else{
            return $qb->setMaxResults(10)->getQuery()->getResult();
        }

    }

//    /**
//     * @return Page[] Returns an array of Page objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Page
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
