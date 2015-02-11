<?php

namespace AppBundle\Data;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Chart\Data\DoctrineDataProcessor;

class PropinsiDataProcessor extends DoctrineDataProcessor
{
    public function __construct(ObjectManager $objectManager, $class)
    {
        parent::__construct($objectManager, $class);
    }

    public function getScope()
    {
        return 'propinsi';
    }

    public function getName()
    {
        return 'propinsi';
    }
}