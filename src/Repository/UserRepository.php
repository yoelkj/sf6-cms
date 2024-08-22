<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /*
    public function getRow(
        $user, 
        $product, 
        $admin = null,
        $no_scandallo = false
      ){

      $arr_data = [];
      
      $logueed_user = $this->security->getUser();

      if(!$agency){
        $agency = $logueed_user;
      }

      $arr_data['id'] = $agency->getId();
      $arr_data['name'] = $agency->getName();
      $arr_data['is_superuser'] = $agency->isIsSuperuser();
      $arr_data['etype'] = $etype;
      $arr_data['slug'] = $agency->getSlug();
      $arr_data['commision'] = $this->getCommision($agency);

      if((!$admin && $logueed_user instanceof Agency && $logueed_user->isIsSuperuser()) || $no_scandallo){
        $arr_data['scandallos'] = [];
      }else{
        $arr_data['scandallos'] = $this->_em->getRepository('App\\Entity\\AgencyScandallo')->getRowsWithParent($agency);
      }
      
      //set prices
      if($event){
        $arr_data = $this->_em->getRepository('App\\Entity\\Schedule')->getPricesByAgency($arr_data, $event, $etype, $no_scandallo);
      }
      
      return $arr_data;

    }
    */



    //    /**
    //     * @return User[] Returns an array of User objects
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

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
