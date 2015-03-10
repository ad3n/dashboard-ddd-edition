<?php
namespace AppBundle\Controller;

/**
 * Author: Muhammad Surya Ihsanuddin<surya.kejawen@gmail.com>
 * Url: http://blog.khodam.org
 */

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/propinsi")
 */
class PropinsiController extends Controller
{
    /**
     * @Route("/", name="propinsi_index")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Propinsi:index.html.twig');
    }
}
