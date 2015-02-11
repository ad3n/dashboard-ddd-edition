<?php

namespace AppBundle\Chart;


interface ChartIndicatorInterface
{
    public function getCredential();

    public function getChartTitle();

    public function getRedIndicator();

    public function getYellowIndicator();

    public function getGreenIndicator();
}