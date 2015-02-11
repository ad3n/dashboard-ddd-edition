<?php

namespace AppBundle\Chart\Data;


interface DataProcessorInterface
{
    public function getName();

    public function getScope();

    public function getData(array $criteria);
}