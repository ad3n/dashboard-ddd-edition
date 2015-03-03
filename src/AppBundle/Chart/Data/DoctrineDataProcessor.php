<?php

namespace AppBundle\Chart\Data;

use Doctrine\ORM\EntityManager;

class DoctrineDataProcessor implements DataProcessorInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $objectManager;

    /**
     * @var string
     */
    protected $class;

    public function __construct(EntityManager $objectManager, $class)
    {
        $this->objectManager = $objectManager;
        $this->class = $class;
    }

    /**
     * @param array $criteria
     * @return \AppBundle\Entity\Data[]|array
     */
    public function getData(array $criteria)
    {
        $qb = $this->objectManager->createQueryBuilder();
        $qb->select('d');
        $qb->from($this->class, 'd');

        if (array_key_exists('propinsi', $criteria) || array_key_exists('regional', $criteria)) {
            if (empty($criteria['regional'])) {
                $qb->andWhere($qb->expr()->orX($qb->expr()->eq('d.propinsi', ':propinsi'), $qb->expr()->eq('d.kabupaten', ':kabupaten')));
                $qb->setParameter('propinsi', $criteria['propinsi']);
                $qb->setParameter('kabupaten', $criteria['kabupaten']);
            } else {
                $qb->andWhere($qb->expr()->eq('d.regional', ':regional'));
                $qb->setParameter('regional', $criteria['regional']);
            }
        }

        $qb->andWhere($qb->expr()->eq('d.indikator', ':indikator'));
        $qb->andWhere($qb->expr()->eq('d.tahun', ':tahun'));
        $qb->andWhere($qb->expr()->eq('d.bulan', ':bulan'));

        $qb->setParameter('indikator', $criteria['indikator']);
        $qb->setParameter('tahun', $criteria['tahun']);
        $qb->setParameter('bulan', $criteria['bulan']);

        return $qb->getQuery()->getResult();
    }

    public function getName()
    {
        return 'doctrine';
    }
}
