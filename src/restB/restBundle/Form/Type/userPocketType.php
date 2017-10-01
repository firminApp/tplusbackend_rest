<?php
namespace restB\restBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class userPocketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('transactionPhone');
        $builder->add('solde');
        $builder->add('accountNumber');
        //$builder->add('userPass');
       // $builder->add('user');

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'restB\restBundle\Entity\userPocket',
            'csrf_protection' => false
        ]);
    }
}