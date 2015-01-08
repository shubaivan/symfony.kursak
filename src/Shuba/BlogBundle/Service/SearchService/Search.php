<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.01.15
 * Time: 16:56
 */

namespace Shuba\BlogBundle\Service\SearchService;

use Shuba\BlogBundle\Entity\MessageRepository;

class Search
{
    protected $repository;

    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function search($string)
    {
        return $this->repository->getIdArrayByName($string);
    }
}