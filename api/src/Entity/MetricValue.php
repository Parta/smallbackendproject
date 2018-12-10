<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetricValueRepository")
 */
class MetricValue {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Metric")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="metric_id", referencedColumnName="id")
     * })
     */
    private $metric;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Brand")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     * })
     */
    private $brand;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=10)
     */
    private $value;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $valueInterval;

    public function getId() {
        return $this->id;
    }

    public function getMetric() {
        return $this->metric;
    }

    public function setMetric(Metric $val) {
        $this->metric = $val;

        return $this;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand(Brand $val) {
        $this->brand = $val;

        return $this;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate) {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate) {
        $this->endDate = $endDate;

        return $this;
    }

    public function getValueInterval() {
        return $this->valueInterval;
    }

    public function setValueInterval(int $valueInterval) {
        $this->valueInterval = $valueInterval;

        return $this;
    }

}
