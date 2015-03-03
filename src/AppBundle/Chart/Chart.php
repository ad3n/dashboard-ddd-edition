<?php

namespace AppBundle\Chart;

use AppBundle\Chart\Data\ChartDataInterface;
use AppBundle\Chart\Data\DataCollectionInterface;
use AppBundle\Block\BlockInterface;

class Chart implements ChartInterface
{
    /**
     * @var BlockInterface
     */
    protected $block;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var array
     */
    protected $data = array();

    /**
     * @var ChartIndicatorInterface
     */
    protected $indicator;

    /**
     * @param BlockInterface $block
     * @return $this
     */
    public function setBlock(BlockInterface $block)
    {
        $this->block = $block;

        return $this;
    }

    /**
     * @return BlockInterface
     */
    public function getBlock()
    {
        return $this->block;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return ChartIndicatorInterface
     */
    public function getIndicator()
    {
        return $this->indicator;
    }

    /**
     * @param ChartDataInterface $chartData
     * @return $this
     */
    protected function addData(ChartDataInterface $chartData)
    {
        $this->data[] = $chartData;

        return $this;
    }

    /**
     * @param DataCollectionInterface $dataCollection
     * @return $this
     */
    public function setData(DataCollectionInterface $dataCollection)
    {
        $datas = $dataCollection->getData();
        $this->indicator = $dataCollection->getIndicator();
        $this->title = strtoupper($this->indicator->getName());

        foreach ($datas as $data) {
            $this->addData($data);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $output = array();

        for ($i = 1; $i <= 12; $i++) {
            foreach ($this->data as $data) {
                if (! isset($output[$data->getYear()])) {
                    $output[$data->getYear()] = array();
                }

                if ($i === $data->getMonth()) {
                    $output[$data->getYear()][$data->getMonth()]['value'] = $data->getValue();
                    $output[$data->getYear()][$data->getMonth()]['nominator'] = $data->getNominator();
                    $output[$data->getYear()][$data->getMonth()]['denominator'] = $data->getDenominator();
                } elseif (! array_key_exists($i, $output[$data->getYear()])) {
                    $output[$data->getYear()][$i]['value'] = 0;
                    $output[$data->getYear()][$i]['nominator'] = 0;
                    $output[$data->getYear()][$i]['denominator'] = 0;
                }
            }
        }

        return $output;
    }

    /**
     * @return int
     */
    public function countData()
    {
        return count($this->data);
    }

    /**
     * @return int
     */
    public function countTotalData()
    {
        $total = 0;

        foreach ($this->data as $value) {
            $total += $value->getNominator();
        }

        return $total;
    }
}