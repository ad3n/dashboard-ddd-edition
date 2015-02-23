<?php
namespace AppBundle\Wilayah;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\SearchableInterface;

class WilayahFactory implements SearchableInterface
{
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function findByKeyword($keyword)
    {
        $propinsi = $this->objectManager->getRepository('AppBundle:Propinsi')->findByKeyword($keyword);
        $kabupaten = $this->objectManager->getRepository('AppBundle:Kabupaten')->findByKeyword($keyword);

        if (! $propinsi) {
            $propinsi = array();
        }

        if (! $kabupaten) {
            $kabupaten = array();
        }

        return array_merge($propinsi, $kabupaten);
    }

    public function getDataForAutoComplete($keyword)
    {
        $data = $this->findByKeyword($keyword);
        $output = array();

        foreach ($data as $key => $wilayah) {
            $output[$key]['id'] = $wilayah->getId();
            $output[$key]['value'] = $wilayah->getName();
        }

        return $output;
    }
}
