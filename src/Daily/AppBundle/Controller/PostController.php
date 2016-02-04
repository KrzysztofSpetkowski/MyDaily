<?php

/**
 * Description of PostController
 *
 * @author krzysiek
 */


namespace Daily\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Daily\AppBundle\Entity\Post;
use Daily\AppBundle\Form\PostType;

class PostController extends Controller 
{
    /**
     * @Route("/new_posts", name="new_posts")
     */
    public function listAction() {
       
        $em = $this->getDoctrine()->getManager();
        $posts = $em
            ->getRepository('AppBundle:Post')
            ->findAll();

        return $this->render('Post/post.html.twig', array(
            'posts' => $posts,
        ));
    }
    
    /**
     * dodawanie nowych postów
     * 
     * @Route("/add_posts", name="add_posts")
     */
    public function addAction(){
       
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $user = $this->getUser();
        
        $post = new Post();
        $post->setUser($user);
        
        $form = $this->createForm(new PostType(), $post);
        $form->handleRequest($request);
        
        if ($form->isValid()){
            $post = $form->getData();
          
            $em->persist($post);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('notise', "Twój post został pomyślnie dodany");
            
            return $this->redirect($this->generateUrl('add_posts'));
        }
        else{
           return $this->render('Post/new.html.twig', array(
           'form'   => $form->createView()
        ));
        }
    }
}
