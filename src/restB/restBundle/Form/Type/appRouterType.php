<?php
namespace restB\restBundle\Form\Type;

use restB\restBundle\Entity\gsmOperator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class appRouterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pays');
        $builder->add('token');
        $builder->add('tel');
        $builder->add('operateur');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'resTB\restBundle\Entity\appRouter',
            'csrf_protection' => false
        ]);
    }
}