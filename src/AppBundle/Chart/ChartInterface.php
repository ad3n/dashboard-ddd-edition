<?php

namespace AppBundle\Chart;

use AppBundle\Chart\Data\DataCollectionInterface;
use AppBundle\Block\BlockInterface;

interface ChartInterface
{
    public function setBlock(BlockInterface $selector);

    public function getScope();

    public function getBlock();

    public function getTitle();

    public function getIndicator();

    public function setData(DataCollectionInterface $data);

    public function getData();

    public function countData();

    public function countTotalData();
}