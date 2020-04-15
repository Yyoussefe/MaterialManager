<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/aboutUs", name="aboutUs")
     */
    public function aboutUs()
    {
        return $this->render('home/aboutUs.html.twig');
    }

    /**
     * @Route("/admin/createMaterial", name="createMaterial")
     */
    public function createMaterial(){
        
    }
}
