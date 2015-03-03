<?php

namespace AppBundle\Entity;

use AppBundle\Block\BlockProviderInterface;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Model\UserInterface;
use Doctrine\ORM\Query\Expr\Join;

class BlockRepository extends EntityRepository implements BlockProviderInterface
{
    public function findBlockByUserAndType(UserInterface $user, $blockType, $location)
    {
        $qb = $this->createQueryBuilder('b');
        $qb->leftJoin('b.user', 'u', Join::WITH, 'b.user = u.id');
        $qb->andWhere($qb->expr()->eq('u.id', $user->getId()));
        $qb->andWhere($qb->expr()->eq('b.blockType', ':blockType'));
        $qb->andWhere($qb->expr()->like('b.location', ':location'));
        $qb->setParameter('blockType', $blockType);
        $qb->setParameter('location', sprintf('%s%%', $location));

        return $qb->getQuery()->getResult();
    }
}
