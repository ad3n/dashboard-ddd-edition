<?php

namespace AppBundle\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Chart\Chart;

/**
 * @Route("/chart")
 **/
class ChartApiController extends  Controller
{
    /**
     * @Route("/get/{indikator}/{scope}/{kode}/{dari}/{sampai}"
     * , name="api_chart"
     * , defaults={"scope" = "nasional", "kode" = "0", "dari" = "0", "sampai" = "0"}
     * )
     * @Method("GET")
     *
     * @param string $indikator
     * @param string $scope
     * @param string $kode
     * @param integer $dari
     * @param integer $sampai
     * @return JsonResponse
     */
    public function getAction($indikator, $scope, $kode, $dari, $sampai)
    {
        $proccessor = $this->container->get('app.chart.data.proccessor_factory')->createDataProccessor($scope);
        $dataCollection = $this->container->get('app.chart.data.doctrine_collection');
        $dataCollection->setProccessor($proccessor);
        $dataCollection->setIndicator($this->getDoctrine()->getRepository('AppBundle:Indikator')->findOneBy(array('code' => $indikator)));

        $criteria = array();
        $from = new \DateTime();
        $from->setDate($from->format('Y'), 1, 1);
        $to = new \DateTime();
        $to->setDate($to->format('Y'), 12, 31);

        if ('nasional' !== $scope && '0' !== $kode) {
            $criteria[$scope] = $kode;
        }

        if ('0' !== $dari) {
            $from = \DateTime::createFromFormat('m_Y', $dari);
            $to = \DateTime::createFromFormat('m_Y', $sampai);
        }

        $dataCollection->setFilter($from, $to, $criteria);

        $chart = new Chart();
        $chart->setData($dataCollection);
        $indicator = $chart->getIndicator();

        $output['indikator']['code'] = $indicator->getCredential();
        $output['indikator']['name'] = $indicator->getChartTitle();
        $output['indikator']['merah'] = $indicator->getRedIndicator();
        $output['indikator']['kuning'] = $indicator->getYellowIndicator();
        $output['indikator']['hijau'] = $indicator->getGreenIndicator();
        $output['scope'] = $chart->getScope();
        $output['data'] = $chart->getData();

        return new JsonResponse($output);
    }
}