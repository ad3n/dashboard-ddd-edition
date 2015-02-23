<?php
namespace AppBundle\Entity;

interface SearchableInterface
{
    public function findByKeyword($keyword);
}
