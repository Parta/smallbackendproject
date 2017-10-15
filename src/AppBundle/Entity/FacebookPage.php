<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="FacebookPages")
 */

class FacebookPage extends Entity
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
     * @ORM\OneToMany(targetEntity="FacebookFanCount", mappedBy="facebookPage")
    **/
    protected $facebookFanCounts;

    public function __construct()
    {
        $this->facebookFanCounts = new ArrayCollection();
    }
}
