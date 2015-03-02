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
     * @Route("/home")
     */
    public function homeAction()
    {
        $user = $this->getUser();
        $block = $this->getDoctrine()->getRepository('AppBundle:Block');
        
        return $this->render('AppBundle:Home:predefined.html.twig', array('block' => $block->findBlockByUserAndType($user, Block::BLOCK_PREDEFINED)));
    }
}