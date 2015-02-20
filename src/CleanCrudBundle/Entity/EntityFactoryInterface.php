<?php

namespace CleanCrudBundle\Entity;


interface EntityFactoryInterface
{
    public function addEntity($entity);

    public function get($entityName);
}