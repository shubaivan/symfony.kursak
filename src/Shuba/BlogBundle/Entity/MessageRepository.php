<?php

namespace Shuba\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends EntityRepository
{
    function getIdArrayByName($name)
    {
        return $this->getEntityManager()->createQuery("SELECT m.id FROM ShubaBlogBundle:Message m WHERE m.message LIKE :name")
            ->setParameter('name', '%'.$name.'%')
            ->getResult();
    }
}
