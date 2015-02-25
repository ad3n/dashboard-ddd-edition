<?php

namespace CleanCrudBundle\Entity;


interface EntityFactoryInterface
{
    public function addEntity(EntityInterface $entity);

    public function get($entityName);
}