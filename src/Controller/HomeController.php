<?php

namespace App\Controller;

use App\Entity\Material;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    public function createMaterial(Request $request)
    {
        $material = new Material();
        $form = $this->createFormBuilder($material)
            ->add("type")
            ->add("number")
            ->add("description")
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $material ->setCreatedAt(new \DateTime());
            $objectManager = $this->getDoctrine()->getManager();
            $objectManager->persist($material);
            $objectManager->flush();
            
            // redirect to same page in order to clear the form after submission
            return $this->redirect($request->getUri());
        }
        return $this->render(
            'admin/createMaterial.html.twig', [
            "materialForm" => $form->createView()
            ]
        );
    }
}
