<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="FacebookFanCounts")
 */

class FacebookFanCount
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    **/
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FacebookPage", inversedBy="pages")
     * @ORM\JoinColumn(name="id_page", referencedColumnName="id")
    **/
    private $page;

    /**
     * @ORM\Column(type="integer", name="value")
    **/
    private $value;

    /**
     * @ORM\Column(type="datetime", name="date")
    **/
    private $date;
}
