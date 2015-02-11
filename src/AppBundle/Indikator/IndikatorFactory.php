<?php

namespace AppBundle\Indikator;

use Doctrine\Common\Persistence\ObjectManager;

class IndikatorFactory implements IndikatorFactoryInterface
{
    protected $repository;

    public function __construct(ObjectManager $objectManager)
    {
        $this->repository = $objectManager->getRepository('AppBundle:Indikator');
    }

    public function buildList($indicatorCode)
    {
        $code = substr($indicatorCode, -1, 2);

        if ('00' === $code) {
            $this->childIndicatorProcessor($indicatorCode);
        } else {
            $prefix = substr($indicatorCode, 0, 2);
            $indicatorCode = sprintf('%s00', $prefix);

            $this->parentIndicatorProcessor($indicatorCode);
        }
    }

    public function childIndicatorProcessor($indicatorCode)
    {
        return $this->repository->findOneBy(array('code' => $indicatorCode));
    }

    public function parentIndicatorProcessor($indcatorCode)
    {
        return $this->repository->getChildIndikatorByParentCode($indcatorCode);
    }
}