<?php

namespace AppBundle\Data;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Chart\Data\DoctrineDataProcessor;

class KabupatenDataProcessor extends DoctrineDataProcessor
{
    public function __construct(ObjectManager $objectManager, $class)
    {
        parent::__construct($objectManager, $class);
    }

    public function getScope()
    {
        return 'kecamatan';
    }

    public function getName()
    {
        return 'kabupaten';
    }
}