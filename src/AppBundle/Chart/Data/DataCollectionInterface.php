<?php

namespace AppBundle\Chart\Data;

use AppBundle\Chart\ChartIndicatorInterface;

interface DataCollectionInterface
{
    public function setIndicator(ChartIndicatorInterface $indicator);

    public function getIndicator();

    public function getData();

    public function getScope();
}