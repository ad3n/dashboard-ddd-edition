<?php
namespace AppBundle\Regional;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\SearchableInterface;

class RegionalFactory implements SearchableInterface
{
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function findByKeyword($keyword)
    {
        $regional = $this->objectManager->getRepository('AppBundle:Regional')->findByKeyword($keyword);

        if (! $regional) {
            $regional = array();
        }

        return $regional;
    }

    public function getDataForAutoComplete($keyword)
    {
        $data = $this->findByKeyword($keyword);
        $output = array();

        foreach ($data as $key => $regional) {
            $output[$key]['id'] = $regional->getCode();
            $output[$key]['value'] = $regional->getName();
        }

        return $output;
    }
}
