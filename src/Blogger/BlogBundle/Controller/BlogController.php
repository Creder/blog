<?php

namespace Blogger\BlogBundle\Controller;

use Blogger\BlogBundle\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
  use FOS\RestBundle\Controller\Annotations as Rest;
 use FOS\RestBundle\Controller\FOSRestController;
 use FOS\RestBundle\Controller\Annotations\Get;
 use FOS\RestBundle\Controller\Annotations\Post;
 use FOS\RestBundle\Controller\Annotations\Route;

// use FOS\RestBundle\Controller\Annotations\Delete;
// use FOS\RestBundle\Controller\Annotations\Put;
// use FOS\RestBundle\Controller\Annotations\View;
// use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
/**
 * Blog controller.
 *
 * @Route("/")
 */
class BlogController extends Controller
{
    /**
     * Lists all blog entities.
     * 
     * @Get("/blogs")
     * 
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $blogs = $em->getRepository('BloggerBlogBundle:Blog')->findByPublished(true);
        
        return $this->render('blog/index.html.twig', array(
            'blogs' => $blogs,
        ));
    }

    /**
     * Creates a new blog entity.
     *
     * @Get("/blogs/new",)
     * 
     */
    public function newAction(Request $request)
    {
        $blog = new Blog();
        $form = $this->createForm('Blogger\BlogBundle\Form\BlogType', $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();

            return $this->redirectToRoute('show', array('id' => $blog->getId()));
        }

        return $this->render('blog/new.html.twig', array(
            'blog' => $blog,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a blog entity.
     *
     * @Get("/blogs/{id}")
     * 
     */
    public function showAction(Blog $blog)
    {
        //$deleteForm = $this->createDeleteForm($blog);
        if($blog->getPublished() == true){
            return $this->render('blog/show.html.twig', array(
            'blog' => $blog,

        ));
        }
        else
        {
             return $this->redirectToRoute('index');   
        }
        
    }

    // /**
    //  * Displays a form to edit an existing blog entity.
    //  *
    //  * @Rest\Get("/blogs/{id}/edit")
    //  * @Rest\Post("/blogs/{id}/edit")
    //  */
    // public function editAction(Request $request, Blog $blog)
    // {
    //     $deleteForm = $this->createDeleteForm($blog);
    //     $editForm = $this->createForm('Blogger\BlogBundle\Form\BlogType', $blog);
    //     $editForm->handleRequest($request);

    //     if($blog->getPublished() == true){
    //         if ($editForm->isSubmitted() && $editForm->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('show', array('id' => $blog->getId()));
    //         }

    //         return $this->render('blog/edit.html.twig', array(
    //             'blog' => $blog,
    //             'edit_form' => $editForm->createView(),
    //             'delete_form' => $deleteForm->createView(),
    //     ));
    //     }
    //     else
    //     {
    //          return $this->redirectToRoute('_index');  
    //     }
    // }

    // /**
    //  * Deletes a blog entity.
    //  *
    //  * @Rest\Delete("/blogs/{id}")
    //  * 
    //  */
    // public function deleteAction(Request $request, Blog $blog)
    // {
    //     $form = $this->createDeleteForm($blog);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->remove($blog);
    //         $em->flush();
    //     }

    //     return $this->redirectToRoute('index');
    // }

    // /**
    //  * Creates a form to delete a blog entity.
    //  *
    //  * @param Blog $blog The blog entity
    //  *
    //  * @return \Symfony\Component\Form\Form The form
    //  */
    // private function createDeleteForm(Blog $blog)
    // {
    //     return $this->createFormBuilder()
    //         ->setAction($this->generateUrl('delete', array('id' => $blog->getId())))
    //         ->setMethod('DELETE')
    //         ->getForm()
    //     ;
    // }
}
