<?php
namespace AppBundle\Entity\FanPage\Facebook;

use AppBundle\Entity\Entity;
use AppBundle\Entity\FanPage\FanCount;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="FacebookFanCounts")
 */

class FacebookFanCount extends FanCount
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="FacebookPage", inversedBy="pages")
     * @ORM\JoinColumn(name="id_page", referencedColumnName="id")
    **/
    protected $page;

    /**
     * @ORM\Column(type="integer", name="value")
    **/
    protected $value;

    /**
     * @ORM\Column(type="datetime", name="date")
    **/
    protected $date;
}
