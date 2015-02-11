<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

class IndikatorRepository extends EntityRepository
{
    public function getChildIndikatorByParentCode($parentCode)
    {
        $shortCode = substr($parentCode, 0, 2);

        $qb = $this->createQueryBuilder('i');
        $qb->andWhere('i.code LIKE :short')
            ->andWhere('i.code <> :parent')
            ->addOrderBy('i.code')
            ->setParameter('short', sprintf('%%%s%%', $shortCode))
            ->setParameter('parent', $parentCode);

        return $qb->getQuery()->getResult();
    }
}
