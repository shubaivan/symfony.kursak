<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 06.01.15
 * Time: 16:24
 */
namespace Shuba\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function categoryTreeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('ShubaBlogBundle:Category');
        $options = array(
            'decorate' => true,
            'nodeDecorator' => function($node) {
                return '<a href="/category/'.$node['id'].'">'.$node['title'].'</a>';
            }
        );
        $htmlTree = $repo->childrenHierarchy(null, false,  $options);

        return new Response($htmlTree);
    }
}