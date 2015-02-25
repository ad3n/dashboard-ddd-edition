<?php

namespace CleanCrudBundle\Entity;


interface EntityInterface
{
    public function getEntityName();

    public function getForm();
}