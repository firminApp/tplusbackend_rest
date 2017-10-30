<?php
namespace restB\restBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SmsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('from');
        $builder->add('to');
        $builder->add('body');
       $builder->add('pocketsender');
       $builder->add('sendresponse');
        $builder->add('datesend');
        $builder->add('couttotal');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'restB\restBundle\Entity\smsFromMaxiSms',
            'csrf_protection' => false
        ]);
    }
}