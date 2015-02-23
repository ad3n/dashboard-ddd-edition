<?php

namespace AppBundle\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $wilayahFactory = $this->container->get('app.wilayah.factory');
        return new JsonResponse($wilayahFactory->getDataForAutoComplete(strtoupper($query)));
    }
}