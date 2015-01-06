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

        return $this->render('ShubaBlogBundle:Post:index.html.twig', array('posts'=>$posts));
    }

    public function showAction($slug)
    {
        $post = $this->getDoctrine()->getRepository('ShubaBlogBundle:Post')
            ->findOneBySlug($slug);

        $post->setViewsNumber($post->getViewsNumber() + 1);
        $this->getDoctrine()->getManager()->flush();

        return $this->render('ShubaBlogBundle:Post:show.html.twig', array('post'=>$post));
    }

    public function viewPostsOfCategoryAction($id)
    {
        $posts = $this->getDoctrine()->getRepository('ShubaBlogBundle:Post')
            ->findByCategory($id);

        if (!$posts) {
            throw $this->createNotFoundException('No posts found');
        }

        return $this->render('ShubaBlogBundle:Post:index.html.twig', array('posts'=>$posts));
    }

}
