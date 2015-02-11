<?php

namespace AppBundle\Block;

interface BlockInterface
{
    const BLOCK_PREDEFINED = 'predefined';

    const BLOCK_TEMATIC = 'tematic';

    const BLOCK_CUSTOM = 'custom';

    /**
     * @return string
     **/
    public function getCredential();

    /**
     * @return string
     **/
    public function getLocation();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     **/
    public function getJQuerySelector();

    /**
     * @return \AppBundle\Chart\ChartIndicatorInterface
     **/
    public function getIndicator();

    /**
     * @return \FOS\UserBundle\Model\UserInterface
     **/
    public function getUser();
}