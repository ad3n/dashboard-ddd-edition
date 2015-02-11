<?php

namespace AppBundle\Chart\Data;


interface DataProccessorInterface
{
    public function getName();

    public function getScope();

    public function getData(array $criteria);
}