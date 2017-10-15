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

    public function formatFacebookFanCounts(string $format): array
    {
        $format = ucfirst($format);
        switch($format) {
            case 'Linechart':
            case 'Table':
            case 'Multiplepage':
                return $this->{'format'.$format}();
            default:
                return [
                    'error' => true,
                    'message' => "$format is not a valid format"
                ];
        }
    }

    protected function formatLinechart(): array
    {
        $contents = [
            'error' => false,
            'data' => []
        ];
        foreach( $this->facebookFanCounts as $fanCount ) {
            $contents['data'][] = [
                'date' => $fanCount->get('date')->getTimestamp(),
                'value' => $fanCount->get('value')
            ];
        }
        return $contents;
    }

    protected function formatTable(): array
    {
        $contents = [
            'error' => false,
            'data' => []
        ];
        foreach( $this->facebookFanCounts as $fanCount ) {
            $contents['data'][$fanCount->get('date')->getTimestamp()] = $fanCount->get('value');
        }
        return $contents;
    }

    protected function formatMultiplepage(): array
    {
        $contents = [
            'error' => false,
            'data' => []
        ];
        $path = $this->path;
        foreach( $this->facebookFanCounts as $fanCount ) {
            $contents['data'][$path][] = [
                'date' => $fanCount->get('date')->getTimestamp(),
                'value' => $fanCount->get('value')
            ];
        }
        return $contents;
    }
}
