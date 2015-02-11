<?php

namespace AppBundle\Chart;


interface ChartWithCategoryInterface
{
    public function addCategory($category);

    public function setCategories(array $array);

    public function getCategories();
}