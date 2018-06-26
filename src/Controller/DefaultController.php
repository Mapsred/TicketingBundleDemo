<?php


namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="default_page")
     */
    public function defaultAction()
    {
//        if ($this->getUser()) {
//            return $this->redirectToRoute('ticketing_perso');
//        }

        return $this->render('Default/homepage.html.twig');
    }
}