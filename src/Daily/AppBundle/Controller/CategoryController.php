<?php


/**
 * Description of CategoryController
 *
 * @author krzysiek
 */

namespace Daily\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
   
    /**
     * @Route("/category", name="category")
     */
    public function indexAction(){
        $categories = $this->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll();
        return $this->render('Category/category.html.twig', array(
             'categories' => $categories,
        ));
    }       
}
