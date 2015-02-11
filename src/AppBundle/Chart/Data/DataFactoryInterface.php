<?php

namespace AppBundle\Chart\Data;

interface DataFactoryInterface
{
    public function addDataProcessor(DataProcessorInterface $dataProcessor);

    public function createDataProcessor($name);
}