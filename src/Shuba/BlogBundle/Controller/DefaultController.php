<?php

namespace Shuba\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('ShubaBlogBundle:Post')
            ->findAll();

        if (!$posts) {
            throw $this->createNotFoundException('No posts found');
        }

        return $this->render('@ShubaBlog/Post/index.html.twig', array('posts'=>$posts));
    }

}
