<?php

namespace AppBundle\Chart\Data;


class DataFactory implements DataFactoryInterface
{
    protected $dataProccessor;

    /**
     * @param DataProccessorInterface $dataProccessor
     */
    public function addDataProccessor(DataProccessorInterface $dataProccessor)
    {
        $this->dataProccessor[$dataProccessor->getName()] = $dataProccessor;
    }

    /**
     * @param $name
     * @return DataProccessorInterface
     */
    public function createDataProccessor($name)
    {
        return $this->dataProccessor[$name];
    }
}