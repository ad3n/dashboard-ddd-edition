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

        exit();
    }

    /**
     * @Route("/home/")
     */
    public function homeAction()
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
     * @Route("/filter/{wilayah}/{regional}/{dari}/{sampai}/")
     */
    public function filterAction($wilayah, $regional, $dari, $sampai)
    {
        $user = $this->getUser();
        $block = $this->getDoctrine()->getRepository('AppBundle:Block');
        $scope = 'wilayah';
        $value = $wilayah;

        if ('0' === $wilayah) {
            $scope = 'regional';
            $value = $regional;
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
}