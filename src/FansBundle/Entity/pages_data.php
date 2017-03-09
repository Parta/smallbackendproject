<?php

namespace FansBundle\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="pages_data",indexes={@Index(name="pageId_index", columns={"page_id"})}))
 * @ORM\HasLifecycleCallbacks
 */
class pages_data
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $fans;

    /**
     * @ORM\Column(type="timestamp")
     */
    private $date;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fans
     *
     * @param integer $fans
     *
     * @return pages_data
     */
    public function setFans($fans)
    {
        $this->fans = $fans;

        return $this;
    }

    /**
     * Get fans
     *
     * @return int
     */
    public function getFans()
    {
        return $this->fans;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return pages_data
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @ORM\ManyToOne(targetEntity="pages")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    private $pages;

    /**
     * Set pages
     *
     * @param \FansBundle\Entity\pages $pages
     *
     * @return pages_data
     */
    public function setPages(\FansBundle\Entity\pages $pages = null)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return \FansBundle\Entity\pages
     */
    public function getPages()
    {
        return $this->pages;
    }
    /**
     * @var integer
     */
    private $page_id;


    /**
     * Set pageId
     *
     * @param integer $pageId
     *
     * @return pages_data
     */
    public function setPageId($pageId)
    {
        $this->page_id = $pageId;

        return $this;
    }

    /**
     * Get pageId
     *
     * @return integer
     */
    public function getPageId()
    {
        return $this->page_id;
    }
}
