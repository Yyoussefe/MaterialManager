<?php
/**
 * File HomeController.php
 * 
 * PHP version 7.3.5
 * 
 * @category Home
 * @package  App\Controller
 * @author   ELHOR Youssef <elhor.yyoussef@hotmail.com>
 * @license  http://licence-test licence-test
 * @link     http://127.0.0.1:8000/home
 */

namespace App\Controller;

use App\Entity\Material;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * HomeController class
 * 
 * @category Home
 * @package  App\Controller
 * @author   ELHOR Youssef <elhor.yyoussef@hotmail.com>
 * @license  http://licence-test licence-test
 * @link     http://127.0.0.1:8000/home
 */
class HomeController extends AbstractController
{
    /**
     * Rendering the index template (home page)
     * 
     * @Route("/home", name="home")
     * 
     * @return template
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * Rendering the about us template (information page)
     * 
     * @Route("/aboutUs", name="aboutUs")
     * 
     * @return template
     */
    public function aboutUs()
    {
        return $this->render('home/aboutUs.html.twig');
    }

    /**
     * Rendering the create new material template (page for new material creation)
     * 
     * @param Request $request holds information about the client request
     * 
     * @Route("/admin/createMaterial", name="createMaterial")
     * 
     * @return template
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
        if ($form->isSubmitted() && $form->isValid()) {
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
