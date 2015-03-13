<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Block;

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
     * @Route("/filter/{wilayah}/{regional}/{dari}/{sampai}/", "home_filtered")
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

        if ('0' === $wilayah && '0' === $regional) {
            unset($criteria['wilayah']);
        } else {
            if ('0' === $wilayah) {
                $scope = 'regional';
                $value = $regional;
            }
        }

        $criteria = array();
        $from = new \DateTime();
        $from->setDate($from->format('Y'), 1, 1);
        $to = new \DateTime();
        $to->setDate($to->format('Y'), 12, 31);

        if ('0' !== $dari) {
            $from = \DateTime::createFromFormat('m_Y', $dari);
            $to = \DateTime::createFromFormat('m_Y', $sampai);
        }

        $proccessor = $proccessor = $this->container->get('app.chart.data.processor_factory')->createDataProcessor('regional');
        if (array_key_exists('wilayah', $criteria)) {
            $proccessor = $this->container->get('app.chart.data.processor_factory')->createDataProcessor('wilayah');
        }

        $dataCollection = $this->container->get('app.chart.data.doctrine_collection');
        $dataCollection->setProcessor($proccessor);
        $dataCollection->setIndicator($this->getDoctrine()->getRepository('AppBundle:Indikator')->findOneBy(array('code' => $indikator)));

        $dataCollection->setFilter($from, $to, $criteria);

        $chart = new Chart();
        $chart->setData($dataCollection);

        \Symfony\Component\VarDumper\VarDumper::dump($chart->getData());
        exit();
    }
}