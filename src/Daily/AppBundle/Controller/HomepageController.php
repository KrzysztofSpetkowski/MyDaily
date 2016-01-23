<?php

/**
 * Description of HomepageController
 *
 * @author krzysiek
 */


namespace Daily\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // pobieramy listę ostatnio dodanych produktów
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->findAll();
        
        return $this->render('base.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/set-locale/{locale}", name="set_locale")
     */
    public function setLocaleAction($locale, Request $request)
    {
        $request->getSession()->set('_locale', $locale);

        return $this->redirect($request->headers->get('referer'));
    }
}