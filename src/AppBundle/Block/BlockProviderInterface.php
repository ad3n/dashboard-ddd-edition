<?php

namespace AppBundle\Block;

use FOS\UserBundle\Model\UserInterface;

interface BlockProviderInterface
{
    public function findBlockByUserAndType(UserInterface $user, $blockType, $location);
}