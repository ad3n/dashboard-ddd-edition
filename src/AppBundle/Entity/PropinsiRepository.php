<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PropinsiRepository extends EntityRepository implements SearchableInterface
{
    public function findByKeyword($keyword)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->andWhere($qb->expr()->like('a.name', $qb->expr()->literal('%'.$keyword.'%')));


        return $qb->getQuery()->getResult();
    }
}
