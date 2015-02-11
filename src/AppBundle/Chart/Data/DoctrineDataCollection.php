<?php

namespace AppBundle\Chart\Data;

use AppBundle\Chart\ChartIndicatorInterface;

class DoctrineDataCollection implements DataCollectionInterface
{
    /**
     * @var DataProccessorInterface
     */
    protected $proccessor;

    /**
     * @var array
     */
    protected $filter;

    /**
     * @var \DateTime
     */
    protected $from;

    /**
     * @var \DateTime
     */
    protected $to;

    /**
     * @var ChartIndicatorInterface
     */
    protected $indicator;

    public function __construct(DataProccessorInterface $proccessor = null)
    {
        if ($proccessor) {
            $this->setProccessor($proccessor);
        }
    }

    public function setProccessor(DataProccessorInterface $proccessor)
    {
        $this->proccessor = $proccessor;

        return $this;
    }

    /**
     * @param ChartIndicatorInterface $indicator
     * @return $this
     */
    public function setIndicator(ChartIndicatorInterface $indicator)
    {
        $this->indicator = $indicator;

        return $this;
    }

    /**
     * @return ChartIndicatorInterface
     */
    public function getIndicator()
    {
        return $this->indicator;
    }

    /**
     * @param \DateTime $from
     * @param \DateTime $to
     * @param array $criteria
     * @return $this
     */
    public function setFilter(\DateTime $from, \DateTime $to, array $criteria = array())
    {
        $this->filter = $criteria;
        $this->from = $from;
        $this->to = $to;

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = array();

        for ($i = $this->from->format('Y'); $i <= $this->to->format('Y'); $i++) {
            for ($j = $this->from->format('n'); $j <= $this->to->format('n'); $j++) {
                $criteria = array_merge($this->filter, array(
                    'indikator' => $this->indicator->getCredential(),
                    'tahun' => $i,
                    'bulan' => $j,
                ));

                $data = array_merge($data, $this->proccessor->getData($criteria));
            }
        }

        return $data;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->proccessor->getScope();
    }
}