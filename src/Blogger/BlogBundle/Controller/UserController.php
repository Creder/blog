<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;

class UserController extends FOSRestController
{
	public function getUsersAction()
    {
        $users = $this->getDoctrine()
            ->getRepository('BloggerBlogBundle:User')
            ->findAll();
        
        return ['users' => $users];
    }
    
    // "get_user"      [GET] /users/{id}
    public function getUserAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository('BloggerBlogBundle:User')
            ->find($id);
        
        if (!$user) {
            throw $this->createNotFoundException();
        }
        
        return ['user' => $user];
	}
}

