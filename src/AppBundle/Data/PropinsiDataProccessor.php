<?php

namespace AppBundle\Data;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Chart\Data\DoctrineDataProccessor;

class PropinsiDataProccessor extends DoctrineDataProccessor
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