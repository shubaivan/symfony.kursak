<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.01.15
 * Time: 15:53
 */
namespace Shuba\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', 'text', array('label'=>'Your Name: '))
            ->add('mail', 'email', array('label'=>'Email: '))
            ->add('message', 'textarea')
            ->add('save', 'submit')
            ->getForm();
    }

    public function getName()
    {
        return 'message';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Shuba\BlogBundle\Entity\Message',
        ));
    }
}

