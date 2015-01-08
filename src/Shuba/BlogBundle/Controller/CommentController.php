<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 06.01.15
 * Time: 18:40
 */
namespace Shuba\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route as Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method as Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template as Template;
use Shuba\BlogBundle\Entity\Comment;
use Shuba\BlogBundle\Form\Type\AddCommentType;


class CommentController extends Controller
{

    public function createCommentAction($slug, Request $request)
    {
        $comment = new Comment();

        $form = $this->createForm(new AddCommentType(), $comment);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $comment->setPost($this->getDoctrine()->getRepository('ShubaBlogBundle:Post')->findOneBySlug($slug));

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $post = $this->getDoctrine()->getRepository('ShubaBlogBundle:Post')->findBySlug($slug);

            $comments = array();

            for ($i = 0; $i < count($post[0]->getComment()); $i++) {
                $comments[$i]["author"] = $post[0]->getComment()[$i]->getAuthor();
                $comments[$i]["text"] = $post[0]->getComment()[$i]->getText();
                $comments[$i]["createdAt"] = $post[0]->getComment()[$i]->getCreatedAt()->format("d.m.Y H:i:s");
            }

            return new JsonResponse($comments);
        }

        return new JsonResponse([], 500);

    }
}
