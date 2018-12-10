<?php

namespace App\Repository;

use App\Entity\Brand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Brand|null find($id, $lockMode = null, $lockVersion = null)
 * @method Brand|null findOneBy(array $criteria, array $orderBy = null)
 * @method Brand[]    findAll()
 * @method Brand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrandRepository extends ServiceEntityRepository {

    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Brand::class);
    }

    public function importBrands($data, $acceptedBrands = []) {
        if (empty($acceptedBrands)) {
            return [];
        }
        
        $em = $this->getEntityManager();
        $currentBrands = $this->getBrandsIndexedByApiId();
        
        foreach ($data as $brandData) {
            if (in_array($brandData['id'], $acceptedBrands) && !in_array($brandData['id'], $currentBrands)) {
                $item = new Brand;
                $item->setApiId($brandData['id']);
                $item->setName($brandData['name']);
                $em->persist($item);
            }
        }
        
        $em->flush();
    }
    
    public function getBrandImportList() {
        $items = $this->findAll();
        $results = [];
        
        foreach ($items as $item) {
            $results[$item->getApiId()] = $item->getId();
        }
        
        return $results;
    }
    
    public function getBrandsIndexedByApiId() {
        $items = $this->findAll();
        $results = [];
        
        foreach ($items as $item) {
            $results[$item->getApiId()] = $item->getId();
        }
        
        return $results;
    }

    // /**
    //  * @return Brand[] Returns an array of Brand objects
    //  */
    /*
      public function findByExampleField($value)
      {
      return $this->createQueryBuilder('b')
      ->andWhere('b.exampleField = :val')
      ->setParameter('val', $value)
      ->orderBy('b.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult()
      ;
      }
     */

    /*
      public function findOneBySomeField($value): ?Brand
      {
      return $this->createQueryBuilder('b')
      ->andWhere('b.exampleField = :val')
      ->setParameter('val', $value)
      ->getQuery()
      ->getOneOrNullResult()
      ;
      }
     */
}
