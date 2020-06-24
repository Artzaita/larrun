<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticPagesController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        return $this->render('static_pages/index.html.twig');
    }


    /**
     *  @Route("/réalisations", name="app_real")
     */
    public function real()
    {
    	return $this->render('static_pages/réalisation.html.twig');
    }
}
