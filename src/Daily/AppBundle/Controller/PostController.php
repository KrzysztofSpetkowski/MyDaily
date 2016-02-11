<?php

/**
 * Description of PostController
 *
 * @author krzysiek
 */


namespace Daily\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

use Daily\AppBundle\Entity\Post;
use Daily\AppBundle\Form\PostType;

class PostController extends Controller 
{
     
    /**
     * @Route("/new_posts", name="new_posts")
     */
    public function listAction(Request $request) {
//        $getPostQuery = $this->getDoctrine()
//                ->getRepository('AppBundle:Post')
//                ->getPostQuery($this->getUser());
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT p FROM AppBundle:Post p";
        $query = $em->createQuery($dql);
                
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
//            $getPostQuery,
            $query,
            $request->query->get('page', 1),
            5   
                );
                
        return $this->render('Post/post.html.twig', array(
            'pages' => $pagination,
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
    
    /**
     * @Route("/szukaj", name="posts_search")
     */
    public function searchAction (Request $request){
        
        $query = $request->query->get('query');
     
        
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:Post')
            ->createQueryBuilder('p')
            ->select('p')
            ->where('p.title LIKE :query')
            ->orWhere('p.description LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->getQuery()
            ->getResult();
        
        return $this->render('Post/search.html.twig', [
            'query'     => $query,
            'posts'  => $posts
        ]);
    }
}
