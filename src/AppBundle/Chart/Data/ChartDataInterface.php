<?php

namespace AppBundle\Chart\Data;


interface ChartDataInterface
{
    public function getYear();

    public function getMonth();

    public function getValue();

    public function getNominator();

    public function getDenominator();
}