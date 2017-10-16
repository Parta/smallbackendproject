<?php
namespace AppBundle\Entity\FanPage\Facebook;

use AppBundle\Entity\Entity;
use AppBundle\Entity\FanPage\Page;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="FacebookPages")
 */

class FacebookPage extends Page
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
     * @ORM\Column(type="string", name="path", unique=true)
    **/
    protected $path;

    /**
     * @ORM\OneToMany(targetEntity="FacebookFanCount", mappedBy="page")
    **/
    protected $fanCounts;
}
