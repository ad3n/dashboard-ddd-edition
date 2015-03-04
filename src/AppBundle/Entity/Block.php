<?php

namespace AppBundle\Entity;

use AppBundle\Block\BlockInterface;
use AppBundle\Block\BlockLocation;
use AppBundle\Chart\Data\ChartDataInterface;
use FOS\UserBundle\Model\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\BlockRepository")
 * @ORM\Table(name="block")
 **/
class Block implements BlockInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     **/
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="block")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     **/
    protected $user;

    /**
     * @ORM\Column(name="code_indikator", type="string", length=4)
     **/
    protected $indicator;

    /**
     * @ORM\Column(name="chart_type", type="string", length=10)
     **/
    protected $blockType;

    /**
     * @ORM\Column(name="location", type="string", length=17)
     **/
    protected $location;

    public function getId()
    {
        return $this->id;
    }

    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    public function setIndicator(ChartDataInterface $indicator)
    {
        $this->indicator = $indicator;

        return $this;
    }

    public function setType($blockType)
    {
        $type = array(
            BlockInterface::BLOCK_PREDEFINED,
            BlockInterface::BLOCK_TEMATIC,
            BlockInterface::BLOCK_CUSTOM,
        );

        if (! in_array($blockType, $type)) {
            throw new \InvalidArgumentException(sprintf('%s is not valid block type', $blockType));
        }

        $this->blockType = $blockType;

        return $this;
    }

    public function setLocation($blockLocation)
    {
        $location = array(
            BlockLocation::MAP_BLOCK,
            BlockLocation::MAP_INFO_BLOCK,
            BlockLocation::TOP_BLOCK_1,
            BlockLocation::TOP_BLOCK_2,
            BlockLocation::TOP_BLOCK_3,
            BlockLocation::TOP_BLOCK_4,
            BlockLocation::TOP_BLOCK_5,
            BlockLocation::TOP_BLOCK_6,
            BlockLocation::TOTAL_BLOCK_1,
            BlockLocation::TOTAL_BLOCK_2,
            BlockLocation::TOTAL_BLOCK_3,
            BlockLocation::TOTAL_BLOCK_4,
            BlockLocation::TOTAL_BLOCK_5,
            BlockLocation::TOTAL_BLOCK_6,
            BlockLocation::MAIN_BLOCK,
            BlockLocation::INDICATOR_BLOCK,
            BlockLocation::BOTTOM_BLOCK_1,
            BlockLocation::BOTTOM_BLOCK_2,
            BlockLocation::BOTTOM_BLOCK_3,
            BlockLocation::BOTTOM_BLOCK_4,
        );

        if (! in_array($blockLocation, $location)) {
            throw new \InvalidArgumentException(sprintf('%s is not valid block location', $blockLocation));
        }

        $this->location = $blockLocation;

        return $this;
    }

    public function getCredential()
    {
        return sprintf('%s_%s', $this->blockType, $this->location);
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getJQuerySelector()
    {
        return sprintf('#%s', $this->location);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getType()
    {
        return $this->blockType;
    }

    public function getIndicator()
    {
        return $this->indicator;
    }
}
