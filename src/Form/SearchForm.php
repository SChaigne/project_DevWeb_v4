<?php

namespace App\Form;

use App\Data\SearchData;
use App\Repository\CryptoCurrencyRepository;
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
    public $cryptosCategories;
    public $newtabCategories;
    public function __construct(CryptoCurrencyRepository $cryptoRepository)
    {
        $this->cryptosCategories = $cryptoRepository->createQueryBuilder('Crypto')->select('Crypto.category')->distinct()->getQuery()->getResult();

        // dd($this->cryptosCategories[0]["category"]);

        foreach ($this->cryptosCategories as $categ => $value) {
            $this->newtabCategories[$value["category"]] = $value["category"];
        }
        // dd($newtabCategories);
    }

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
            ->add(
                'category',
                ChoiceType::class,
                [
                    'label' => false,
                    'required' => false,
                    'choices' => $this->newtabCategories,
                    'expanded' => true
                ]
            )
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
                'label' => false,
                'required' => false,
                'choices' => [
                    'Aucun' => '',
                    'Prix croissant' => "priceAsc",
                    'Prix décroissant' => "priceDesc"
                ]
            ])
            ->add('orderPriceMarketCap', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'choices' => [
                    'Aucun' => '',
                    'Prix croissant' => "priceMarketCapAsc",
                    'Prix décroissant' => "priceMarketCapDesc"
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
