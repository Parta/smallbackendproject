<?php
namespace AppBundle\Entity;

use AppBundle\Entity\FacebookPage;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="FacebookFanCounts")
 */

class FacebookFanCount extends Entity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    **/
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="FacebookPage", inversedBy="facebookPages")
     * @ORM\JoinColumn(name="id_page", referencedColumnName="id")
    **/
    protected $facebookPage;

    /**
     * @ORM\Column(type="integer", name="value")
    **/
    protected $value;

    /**
     * @ORM\Column(type="datetime", name="date")
    **/
    protected $date;

    public function setFacebookPage(FacebookPage $facebookPage)
    {
        $this->facebookPage = $facebookPage;
    }
}
