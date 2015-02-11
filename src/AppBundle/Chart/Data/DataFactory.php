<?php

namespace AppBundle\Chart\Data;


class DataFactory implements DataFactoryInterface
{
    protected $dataProcessor;

    /**
     * @param DataProcessorInterface $dataProcessor
     */
    public function addDataProcessor(DataProcessorInterface $dataProcessor)
    {
        $this->dataProcessor[$dataProcessor->getName()] = $dataProcessor;
    }

    /**
     * @param $name
     * @return DataProcessorInterface
     */
    public function createDataProcessor($name)
    {
        return $this->dataProcessor[$name];
    }
}