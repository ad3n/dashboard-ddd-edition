<?php

namespace AppBundle\Chart;

class ChartWithCategory extends Chart implements ChartWithCategoryInterface
{
    protected $categories;

    public function __contruct($type)
    {
        parent::__construct($type);
    }

    public function setCategories(array $categories)
    {
        $this->categories = $categories;

        return $this;
    }

    public function addCategory($category)
    {
        $this->categories[] = $category;

        return $this;
    }

    public function getCategories()
    {
        return $this->categories;
    }
}