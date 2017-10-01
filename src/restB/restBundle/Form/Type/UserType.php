<?php
namespace restB\restBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname');
        $builder->add('lastname');
        $builder->add('email');
        $builder->add('tel');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'restB\restBundle\Entity\User',
            'csrf_protection' => false
        ]);
    }
}