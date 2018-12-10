<?php

namespace App\Repository;

use App\Entity\Brand;
use App\Entity\Metric;
use App\Entity\MetricValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MetricValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetricValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetricValue[]    findAll()
 * @method MetricValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetricValueRepository extends ServiceEntityRepository {

    protected $tmpStartDate;
    protected $tmpEndDate;

    public function __construct(RegistryInterface $registry) {
        $this->tmpStartDate = strtotime('2018-09-01 00:00:00');
        $this->tmpEndDate = strtotime('2018-09-30 23:59:59');
        
        parent::__construct($registry, MetricValue::class);
    }

    public function importMetricValues($metricValuesData, $metrics, $interval) {
        $brandList = $this->getEntityManager()->getRepository(Brand::class)->getBrandImportList();
        foreach ($metricValuesData as $brandId => $values) {
            foreach ($values as $periodValues) {
                $this->importPeriodMetricValues($brandList[$brandId], $periodValues, $metrics, $interval);
            }
        }
    }

    protected function importPeriodMetricValues($brandId, $periodValues, $metrics, $interval) {
        if ($this->checkTestPeriod($periodValues)) {
            foreach ($periodValues['metrics'] as $metricValues) {
                $item = new MetricValue;
                $item->setBrand($this->getEntityManager()->getReference(Brand::class, $brandId));
                $item->setMetric($this->getEntityManager()->getReference(Metric::class, $metrics[$metricValues['id']]));
                $item->setValue($metricValues['v']);
                $item->setStartDate(new \DateTime(date('Y-m-d H:i:s',$periodValues['startDate'])));
                $item->setEndDate(new \DateTime(date('Y-m-d H:i:s', $periodValues['endDate'])));
                $item->setValueInterval($interval);
                $this->getEntityManager()->persist($item);
            }
            
            $this->getEntityManager()->flush();
        }
    }
    
    protected function checkTestPeriod($periodValues) {
        return ($periodValues['startDate'] >= $this->tmpStartDate && $periodValues['startDate'] <= $this->tmpEndDate) ||
            ($periodValues['endDate'] >= $this->tmpStartDate && $periodValues['endDate'] <= $this->tmpEndDate);
    }
    
    public function getChartData($interval, $ids) {
        $qb = $this->createQueryBuilder('mv')
                ->select('mv, brand, metric')
                ->leftJoin('mv.brand', 'brand')
                ->leftJoin('mv.metric', 'metric')
                ->where('mv.valueInterval = :interval')->setParameter('interval', $interval)
                ->orderBy('mv.startDate', 'ASC');
        
        if (!empty($ids)) {
            $qb->andWhere('brand.apiId IN (:ids)')->setParameter('ids', $ids);
        }
        
        return $qb->getQuery()->getArrayResult();
    }

    // /**
    //  * @return MetricValue[] Returns an array of MetricValue objects
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
      public function findOneBySomeField($value): ?MetricValue
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
