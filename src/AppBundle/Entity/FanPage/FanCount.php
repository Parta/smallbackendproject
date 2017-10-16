<?php
namespace AppBundle\Entity\FanPage;

use AppBundle\Entity\Entity;
use AppBundle\Entity\FanPage\Page;
use Doctrine\ORM\Mapping as ORM;

abstract class FanCount extends Entity
{
    public function setPage(Page $page): Page
    {
        $this->page = $page;
        return $this->page;
    }
}
