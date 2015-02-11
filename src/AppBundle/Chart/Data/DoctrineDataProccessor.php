<?php

namespace AppBundle\Chart\Data;

use Doctrine\Common\Persistence\ObjectManager;

abstract class DoctrineDataProccessor implements DataProccessorInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;

    public function __construct(ObjectManager $objectManager, $class)
    {
        $this->repository = $objectManager->getRepository($class);
    }

    /**
     * @param array $criteria
     * @return \AppBundle\Entity\Data[]|array
     */
    public function getData(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}