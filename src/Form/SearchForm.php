<?php

namespace App\Form;

use App\Data\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('inputSearch', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Recherche'
                ]
            ])
            // ->add(
            //     'category',
            //     ChoiceType::class,
            //     [
            //         'choices' => [
            //             'Prix croissant' => "priceAsc",
            //             'Prix décroissant' => "priceDesc"
            //         ],
            //         'expanded' => true
            //     ]
            // )
            ->add('minPrice', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Min']
            ])
            ->add('maxPrice', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Max']
            ])
            ->add('minMarketCap', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Min']
            ])
            ->add('maxMarketCap', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => ['placeholder' => 'Max']
            ])
            ->add('orderPrice', ChoiceType::class, [
                'choices' => [
                    'Prix croissant' => "priceAsc",
                    'Prix décroissant' => "priceDesc"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
