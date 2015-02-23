<?php

namespace AppBundle\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Chart\Chart;

/**
 * @Route("/wilayah")
 **/
class WilayahApiController extends  Controller
{
    /**
     * @Route("/get_like/{query}/")
     *
     * @param string $query
     */
    public function getLikeAction($query)
    {
        return new JsonResponse(array('A', 'B', 'C'));
    }
}