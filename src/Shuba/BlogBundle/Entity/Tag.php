<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 01.01.15
 * Time: 16:30
 */
namespace Shuba\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="tag")
 * @ORM\Entity
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(length=64)
     */
    protected $title;

    /**
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tags")
     */
    protected $posts;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Tag
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add posts
     *
     * @param \Shuba\BlogBundle\Entity\Post $posts
     * @return Tag
     */
    public function addPost(\Shuba\BlogBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Shuba\BlogBundle\Entity\Post $posts
     */
    public function removePost(\Shuba\BlogBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
    public function __toString()
    {
        return $this->getTitle();
    }
}
