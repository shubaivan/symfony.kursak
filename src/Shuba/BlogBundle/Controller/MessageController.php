<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.01.15
 * Time: 15:50
 */
namespace Shuba\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Shuba\BlogBundle\Entity\Message;
use Shuba\BlogBundle\Form\Type\MessageType;

class MessageController extends Controller
{
    public  function viewMessagesAction(Request $request)
    {
        $message = new Message();

        $form = $this->createForm(new MessageType(), $message);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirect($this->generateUrl('shuba_blog_viewMessages'));
        }

        $messages = $this->getDoctrine()->getRepository('ShubaBlogBundle:Message')
            ->findAll();

        if (!$messages) {
            throw $this->createNotFoundException('No messages found');
        }

        return $this->render('ShubaBlogBundle:Message:view.html.twig',
            array('messages' => $messages, 'form' => $form->createView(),));
    }
}