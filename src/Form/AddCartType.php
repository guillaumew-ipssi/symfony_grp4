<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', NumberType::class, [
                "html5" => true,
                "scale" => 0,
                "attr" => [
                    "type" => "number",
                    "class" => "form-control",
                    "min" => 0,
                    "max" => $options["maxQuantity"]
                ]
            ])
            ->add('submit', SubmitType::class, [
                "label" => "Ajouter au panier",
                "attr" => [
                    "class" => "btn btn-success"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'maxQuantity' => 0
        ]);

        $resolver->setAllowedTypes("maxQuantity", "int");
    }
}
