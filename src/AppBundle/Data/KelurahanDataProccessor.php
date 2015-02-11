<?php

namespace AppBundle\Data;

use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Chart\Data\DoctrineDataProccessor;

class KelurahanDataProccessor extends DoctrineDataProccessor
{
    public function __construct(ObjectManager $objectManager, $class)
    {
        parent::__construct($objectManager, $class);
    }

    public function getScope()
    {
        return;
    }

    public function getName()
    {
        return 'kelurahan';
    }
}