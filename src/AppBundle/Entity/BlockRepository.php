<?php

namespace AppBundle\Entity;

use AppBundle\Block\BlockProviderInterface;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Model\UserInterface;

class BlockRepository extends EntityRepository implements BlockProviderInterface
{
    public function findBlockByUserAndType(UserInterface $user, $blockType)
    {
        return $this->findBy(array(
            'user' => $user,
            'blockType' => $blockType,
        ));
    }
}
