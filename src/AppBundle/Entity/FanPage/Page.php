<?php
namespace AppBundle\Entity\FanPage;

use AppBundle\Entity\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

abstract class Page extends Entity
{

    public function formatFanCounts(string $format): array
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
        foreach( $this->fanCounts as $fanCount ) {
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
        foreach( $this->fanCounts as $fanCount ) {
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
        foreach( $this->fanCounts as $fanCount ) {
            $contents['data'][$path][] = [
                'date' => $fanCount->get('date')->getTimestamp(),
                'value' => $fanCount->get('value')
            ];
        }
        return $contents;
    }
}
