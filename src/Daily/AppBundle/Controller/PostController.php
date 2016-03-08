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
use Daily\AppBundle\Entity\Comment;
use Daily\AppBundle\Form\CommentType;

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
            'query'  => $query,
            'posts'  => $posts
        ]);
    }
    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function showAction(Post $post, Request $request)
    { 
        // pobieramy aktualnie zalogowanego użytkownika
        $user = $this->getUser();
        // tworzymy nowy komentarz
        $comment = new Comment();
        // przypisujemy produkt do komentarza
        $comment->setPost($post); 
        // przypisuje zalogowanego użytkownika do komentarz
        $comment->setUser($user);
        
        $form = $this->createForm(new CommentType(), $comment);
       
        
        
        // przetwarzamy dane wysłane z formularza - jeśli jakieś dane zostały wysłane
        $form->handleRequest($request);
        
        // jeśli formularz został wysłane, a użytkownik nie jest zalogowany
        if ($form->isSubmitted() && !$user) {
            $this->addFlash('danger', "Aby móc dodawać komentarze musisz się wcześniej zalogować.");
            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }
        // jeśli formularz został wysłane i wszystkie wprowadzone dane sa poprawne
        if ($form->isValid()) {
            
            // jeśli użytkownik posiada uprawnienia administratora
            if ($user->hasRole('ROLE_ADMIN')) {
                // oznaczamy komentarz jako zweryfikowany
                $comment->setVerified(true);
            }
            
            // pobieramy EntityManager
            $em = $this->getDoctrine()->getManager();
            // zapisujemy komentarz do bazy danych
            $em->persist($comment);
            $em->flush();
            
            // jeśli użytkownik posiada uprawnienia admina
            if ($user->hasRole('ROLE_ADMIN')) {
            // if ($user->isAdmin()) {
                $this->addFlash('success', "Komentarz został pomyślnie zapisany i opublikowany");
            } else {
                $this->addFlash('success', "Komentarz został pomyślnie zapisany i oczekuje na weryfikacje");
            }
            
            return $this->redirectToRoute('post_show', ['id' => $post->getId()]);
        }
        
        return $this->render('Post/show.html.twig', [
            'post'   => $post,
            'form'      => $form->createView()
        ]);
    }
    
   
}
