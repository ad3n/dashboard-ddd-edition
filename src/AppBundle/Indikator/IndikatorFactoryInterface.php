<?php

namespace AppBundle\Indikator;

use Doctrine\Common\Persistence\ObjectManager;

interface IndikatorFactoryInterface
{
    public function __construct(ObjectManager $objectManager);

    public function buildList($indicatorCode);
}