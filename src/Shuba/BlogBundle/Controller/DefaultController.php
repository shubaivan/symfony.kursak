<?php

namespace Shuba\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ShubaBlogBundle:Default:index.html.twig', array('name' => $name));
    }
}
