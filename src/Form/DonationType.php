<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class DonationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod(Request::METHOD_POST)
            ->add(
                'amount',
                MoneyType::class,
                [
                    'label' => 'Votre don *',
                    'row_attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'message',
                TextType::class,
                [
                    'label' => 'Un petit message <3',
                    'row_attr' => [
                        'class' => 'form-control'
                    ]
                ]
            );
    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false
        ]);
    }
}
