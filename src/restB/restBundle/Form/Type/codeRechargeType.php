<?php
namespace restB\restBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class codeRechargeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('appRouterToken');
        $builder->add('montant');
        $builder->add('code');
        $builder->add('destinataire');
        $builder->add('isUsed');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'restB\restBundle\Entity\codeRecharge',
            'csrf_protection' => false
        ]);
    }
}