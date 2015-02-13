<?php

namespace AppBundle\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Chart\Chart;
use Symfony\Component\VarDumper\VarDumper;

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
        $proccessor = $this->container->get('app.chart.data.processor_factory')->createDataProcessor($scope);
        $dataCollection = $this->container->get('app.chart.data.doctrine_collection');
        $dataCollection->setProcessor($proccessor);
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

    /**
     * @Route("/get_by_parent/{indikator}/{scope}/{kode}/{dari}/{sampai}"
     * , name="api_chart_indicator_by_parent"
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
    public function getParentIndicatorChartByIndicatorCodeAction($indikator, $scope, $kode, $dari, $sampai)
    {
        $criteria = array();
        $output = array();
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

        $indicators = $this->container->get('app.indicator.factory')->buildList($indikator);

        foreach ($indicators as $key => $indicator) {
            $proccessor = $this->container->get('app.chart.data.processor_factory')->createDataProcessor($scope);
            $dataCollection = $this->container->get('app.chart.data.doctrine_collection');
            $dataCollection->setProcessor($proccessor);
            $dataCollection->setIndicator($indicator);

            $dataCollection->setFilter($from, $to, $criteria);

            $chart = new Chart();
            $chart->setData($dataCollection);
            $indicator = $chart->getIndicator();

            $output[$key]['indikator']['code'] = $indicator->getCredential();
            $output[$key]['indikator']['name'] = $indicator->getChartTitle();
            $output[$key]['indikator']['merah'] = $indicator->getRedIndicator();
            $output[$key]['indikator']['kuning'] = $indicator->getYellowIndicator();
            $output[$key]['indikator']['hijau'] = $indicator->getGreenIndicator();
            $output[$key]['scope'] = $chart->getScope();
            $output[$key]['data'] = $chart->getData();
        }

        return new JsonResponse($output);
    }

    /**
     * @Route("/detail/{indikator}/{scope}/{kode}/{dari}/{sampai}"
     * , name="api_chart_detail"
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
    public function getDetailAction($indikator, $scope, $kode, $dari, $sampai)
    {
        $proccessor = $this->container->get('app.chart.data.processor_factory')->createDataProcessor($scope);
        $dataCollection = $this->container->get('app.chart.data.doctrine_collection');
        $dataCollection->setProcessor($proccessor);
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

        return $this->render('@App/Home/detail.html.twig', array('chart' => $output));
    }
}