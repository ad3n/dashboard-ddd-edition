<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Block;
use AppBundle\Chart\Chart;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        $block = $this->getDoctrine()->getRepository('AppBundle:Block');
        $scope = 'nasional';
        $value = '0';
        $dari = sprintf('1_%s', date('Y'));
        $sampai = date('m_Y');

        return $this->render('AppBundle:Home:predefined.html.twig', array(
            'map' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'map'),
            'top' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'top'),
            'total' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'total'),
            'main' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'main'),
            'bottom' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'bottom'),
            'scope' => $scope,
            'value' => $value,
            'dari' => $dari,
            'sampai' => $sampai,
        ));
    }

    /**
     * @Route("/filter/{wilayah}/{regional}/{dari}/{sampai}/", name="home_filtered")
     */
    public function filterAction($wilayah, $regional, $dari, $sampai)
    {
        $user = $this->getUser();
        $block = $this->getDoctrine()->getRepository('AppBundle:Block');
        $scope = 'wilayah';
        $value = $wilayah;

        if ('0' === $wilayah && '0' === $regional) {
            $scope = 'nasional';
            $value = '0';
        } else {
            if ('0' === $wilayah) {
                $scope = 'regional';
                $value = $regional;
            }
        }

        return $this->render('AppBundle:Home:predefined.html.twig', array(
            'map' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'map'),
            'top' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'top'),
            'total' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'total'),
            'main' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'main'),
            'bottom' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED, 'bottom'),
            'scope' => $scope,
            'value' => $value,
            'dari' => $dari,
            'sampai' => $sampai,
        ));
    }

    /**
     * @Route("/detail_per_indikator/{indikator}/{wilayah}/{regional}/{dari}/{sampai}/", name="detail_per_indikator")
     */
    public function detailAction($indikator, $wilayah, $regional, $dari, $sampai)
    {
        $criteria['indikator'] = $indikator;

        $criteria['wilayah'] = $wilayah;
        $criteria['regional'] = $regional;

        if ('0' === $wilayah && '0' === $regional) {
            unset($criteria['wilayah']);
            unset($criteria['regional']);
        } else {
            if ('0' === $wilayah) {
                $criteria['regional'] = $regional;
            } else {
                $criteria['wilayah'] = $wilayah;
            }
        }

        $criteria = array();
        $from = new \DateTime();
        $from->setDate($from->format('Y'), 1, 1);
        $to = new \DateTime();
        $to->setDate($to->format('Y'), 12, 31);

        if ('0' !== $dari) {
            $from = \DateTime::createFromFormat('m_Y', $dari);
            $from->setDate($from->format('Y'), 1, 1);
            $to = \DateTime::createFromFormat('m_Y', $sampai);
            $to->setDate($to->format('Y'), 12, 1);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $indicator = $this->getDoctrine()->getRepository('AppBundle:Indikator')->findOneBy(array('code' => $indikator));
        $data = array();
        $additionalTitle = '';
        $titleWilayah = 'Propinsi';

        if (false === isset($criteria['wilayah']) && false === isset($criteria['regional'])) {
            $listPropinsi = $this->getDoctrine()->getRepository('AppBundle:Propinsi')->findAll();
            $additionalTitle = 'SECARA NASIONAL';

            foreach ($listPropinsi as $key => $propinsi) {
                $proccessor = $this->container->get('app.chart.data.processor_factory')->createDataProcessor('doctrine');
                $dataCollection = $this->container->get('app.chart.data.doctrine_collection');
                $dataCollection->setProcessor($proccessor);
                $dataCollection->setIndicator($indicator);

                $dataCollection->setFilter($from, $to, $criteria);

                $chart = new Chart();
                $chart->setData($dataCollection);
                $data['daerah'][$key] = $propinsi;
                $data['chart'][$key] = $chart->getData();
            }
        } else {
            if (isset($criteria['wilayah'])) {
                $key = $criteria['wilayah'];
                $temp = 'wilayah';
            } else {
                $key = $criteria['regional'];
            }

            if ('wilayah' === $temp) {
                $additionalTitle = 'DI PROPINSI ';
                $titleWilayah = 'Kabupaten/Kota';

                $daerah = $this->getDoctrine()->getRepository('AppBundle:Propinsi')->findOneBy(array('code' => $key));

                if (! $daerah) {
                    $additionalTitle = 'DI KABUPATEN ';

                    $daerah = $this->getDoctrine()->getRepository('AppBundle:Kabupaten')->findOneBy(array('code' => $key));
                }
            } else {
                $additionalTitle = 'DI REGIONAL ';

                $daerah = $this->getDoctrine()->getRepository('AppBundle:Regional')->findOneBy(array('code' => $key));
            }

            $proccessor = $this->container->get('app.chart.data.processor_factory')->createDataProcessor('doctrine');
            $dataCollection = $this->container->get('app.chart.data.doctrine_collection');
            $dataCollection->setProcessor($proccessor);
            $dataCollection->setIndicator($indicator);

            $dataCollection->setFilter($from, $to, $criteria);

            $chart = new Chart();
            $chart->setData($dataCollection);
            $data['daerah'][] = $daerah;
            $data['chart'][] = $chart->getData();
            $additionalTitle .= $daerah->getName();
        }

        return $this->render('AppBundle:Home:detail.html.twig', array(
            'data' => $data,
            'indicator' => $indicator,
            'dari' => $from,
            'sampai' => $to,
            'additional_title' => $additionalTitle,
            'wilayah_title' => $titleWilayah,
        ));
    }
}