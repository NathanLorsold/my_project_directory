<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ProductName', TextType::class, [
                'label' => 'Nom du produit',
                'help' => 'Indiquez ici le nom complet du produit',
                'attr' => [
                    'placeholder' => 'Produit',
                ],
                ])
            ->add('QuantityPerUnit', TextType::class, [
                'label' => 'Nom du fournisseur',
                ])
            ->add('UnitPrice', TextType::class, [
                'label' => 'Id de la catégorie',
                ])
            ->add('UnitsOnStock', TextType::class, [
                'label' => 'Quantité par unité',
                'attr' => [
                    'placeholder' => 'Quantité par unité',
                ],
                ])
            ->add('UnitsOnOrder', TextType::class, [
                'label' => 'Prix unitaire',
                'attr' => [
                    'placeholder' => 'Prix unitaire',
                ],
                ])
            ->add('ReorderLevel', TextType::class, [
                'label' => 'Quantité en stock',
                'attr' => [
                    'placeholder' => 'Stock',
                ],
                ])
            ->add('Discontinued', TextType::class, [
                'label' => 'Quantité en commande',
                'attr' => [
                    'placeholder' => 'Quantité en commande',
                ],
                ])
            ->add('suppliers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
