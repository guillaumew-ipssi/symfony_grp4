<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\HttpFoundation\Request;

class AdoptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod(Request::METHOD_POST)
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'Prénom *',
                    'row_attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'Nom *',
                    'row_attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'adress',
                TextType::class,
                [
                    'label' => 'Adresse *',
                    'row_attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'city',
                TextType::class,
                [
                    'label' => 'Ville *',
                    'row_attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'zipcode',
                NumberType::class,
                [
                    'label' => 'Code postal *',
                    'row_attr' => [
                        'class' => 'form-control'
                    ]
                ]
            )
            ->add(
                'mobile',
                TelType::class,
                [
                    'label' => 'Téléphone',
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
