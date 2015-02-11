<?php

namespace AppBundle\Chart\Data;

interface DataFactoryInterface
{
    public function addDataProccessor(DataProccessorInterface $dataProccessor);

    public function createDataProccessor($name);
}