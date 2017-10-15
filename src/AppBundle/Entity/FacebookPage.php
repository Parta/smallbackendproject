<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="FacebookPages")
 */

class FacebookPage
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    **/
    private $id;

    /**
     * @ORM\Column(type="string", name="path", unique=true)
    **/
    private $path;

    /**
     * @ORM\OneToMany(targetEntity="FacebookFanCount", mappedBy="page")
    **/
    private $fanCounts;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function get(string $key) {
        return $this->{$key};
    }
}
