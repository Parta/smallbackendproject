<?php

namespace App\Repository;

use App\Entity\Brand;
use App\Entity\Metric;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Metric|null find($id, $lockMode = null, $lockVersion = null)
 * @method Metric|null findOneBy(array $criteria, array $orderBy = null)
 * @method Metric[]    findAll()
 * @method Metric[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetricRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Metric::class);
    }
    
    public function importMetrics($metricList) {
        $currentMetricsList = $this->getMetricsIndexedByName();
        $em = $this->getEntityManager();
        
        $importedData = [];
        
        foreach ($metricList as $metric) {
            if (array_key_exists($metric['name'], $currentMetricsList)) {
                $importedData[$metric['id']] = $currentMetricsList[$metric['name']];
            } else {
                $item = new Metric;
                $item->setName($metric['name']);
                $em->persist($item);
                $em->flush();
                
                $importedData[$metric['id']] = $item->getId();   
            }
        }
        
        return $importedData;
    }
    
    public function getMetricsIndexedByName() {
        $items = $this->findAll();
        $results = [];
        
        foreach ($items as $item) {
            $results[$item->getName()] = $item->getId();
        }
        
        return $results;
    }

    // /**
    //  * @return Metric[] Returns an array of Metric objects
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
    public function findOneBySomeField($value): ?Metric
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
