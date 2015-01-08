<?php

namespace Shuba\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Shuba\BlogBundle\Form\Type\AddCommentType;

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
        $form = $this->createForm(new AddCommentType());


        return $this->render('ShubaBlogBundle:Post:show.html.twig', array(
            "form" => $form->createView(),
            'post'=>$post));
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

    public function lastPostsAction($last_posts_limit = 3)
    {
        $repository = $this->getDoctrine()->getRepository('ShubaBlogBundle:Post');
        $posts = $repository->findLatestPostsLimit($last_posts_limit);

        return $this->render('ShubaBlogBundle:Post:lastPosts.html.twig', array('posts' => $posts));
    }

    public function mostViewedPostsAction($most_viewed_posts_limit = 5)
    {
        $repository = $this->getDoctrine()->getRepository('ShubaBlogBundle:Post');
        $posts = $repository->findMostViewedtPosts($most_viewed_posts_limit);

        return $this->render('ShubaBlogBundle:Post:mostViewedPosts.html.twig', array('posts' => $posts));
    }
}
