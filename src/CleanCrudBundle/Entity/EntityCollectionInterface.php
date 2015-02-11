<?php

namespace CleanCrudBundle\Entity;


interface EntityCollectionInterface
{
    public function addEntity($entity);

    public function get($entityName);
}