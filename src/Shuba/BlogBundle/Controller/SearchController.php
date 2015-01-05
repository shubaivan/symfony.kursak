<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.01.15
 * Time: 17:09
 */

namespace Shuba\BlogBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function searchAction(Request $request)
    {
        $searcher = $this->get('searcher');
        $result = $searcher->search($request->get('search'));
        $repository = $this->getDoctrine()->getRepository('ShubaBlogBundle:Message');
        $query = $repository->createQueryBuilder('m')
            ->where('m.id IN (:ids)')
            ->setParameter('ids', $result)
            ->getQuery();
        $messages = $query->getResult();

        if (!$messages){
            throw $this->createNotFoundException('Opss, dont search');
        }

        return $this->render('ShubaBlogBundle:Search:search.html.twig', array('messages' => $messages));
    }

}