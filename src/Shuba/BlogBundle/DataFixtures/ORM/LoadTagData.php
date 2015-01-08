<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 01.01.15
 * Time: 17:17
 */
namespace Shuba\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Shuba\BlogBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $symfony = new Tag();
        $symfony->setTitle('Symfony2');

        $doctrine = new Tag();
        $doctrine->setTitle('Doctrine');

        $extension = new Tag();
        $extension->setTitle('Extension');

        $template = new Tag();
        $template->setTitle('Template');

        $twig = new Tag();
        $twig->setTitle('Twig');

        $manager->persist($symfony);
        $manager->persist($doctrine);
        $manager->persist($extension);
        $manager->persist($template);
        $manager->persist($twig);

        $manager->flush();

        $this->addReference('symfony-tag', $symfony);
        $this->addReference('doctrine-tag', $doctrine);
        $this->addReference('template-tag', $template);
        $this->addReference('twig-tag', $twig);
        $this->addReference('extension-tag', $extension);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}