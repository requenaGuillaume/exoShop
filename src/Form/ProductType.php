<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder' => 'Exemple : Chaise en bois'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du produit',
                'attr' => [
                    'placeholder' => 'Une chaise en bois de tel bois et de telle dimension'
                ]
            ])
            ->add('price', MoneyType::class, [
                'divisor' => 100,
                'label' => 'Prix' ,
                'attr' => [
                    'placeholder' => '12,99'
                ]
            ])
            ->add('image', UrlType::class, [
                'label' => 'Image (url)',
                'attr' => [
                    'placeholder' => 'Exemple : https://picsum.photos/200/200'
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'class' => Category::class,
                'choice_label' => function(Category $category){
                    return ucfirst($category->getName());
                },
                'placeholder' => '-- Choisir une catégorie --'
                ]
            )
        ;

        // Convert cents to €
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event){

            /** @var Product */
            $product = $event->getData();

            if($product){
                $product->setName(ucfirst($product->getName()));
            }

        });

        // Convert € to cents
        $builder->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event){

            /** @var Product */
            $product = $event->getData();

            if($product){
                $product->setPrice($product->getPrice() * 100);
            }

        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
