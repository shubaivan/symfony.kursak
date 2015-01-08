<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.01.15
 * Time: 16:07
 */

namespace Shuba\BlogBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Shuba\BlogBundle\Entity\Message;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class LoadMessageData  extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        date_default_timezone_set('Europe/Kiev');
        for ($i = 1; $i <= 3; $i++) {
            $message = new Message();

            $message->setAuthor('Inokentij');
            $message->setMail('Inokentij@mail.ru');
            $message->setMessage('If you add a new property with mapping metadata to Product and run this task again, it will generate the "alter table" statement needed to add that new column to the existing product table.');

            $manager->persist($message);
            $manager->flush($message);
        }

    }

    public function getOrder()
    {
        return 4; // the order in which fixtures will be loaded
    }
}