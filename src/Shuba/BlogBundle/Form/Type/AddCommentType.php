<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 06.01.15
 * Time: 18:41
 */
namespace Shuba\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author')
            ->add('text', 'textarea');
    }

    public function getName()
    {
        return 'comment';
    }
}
