<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('roles')
            ->add('password', PasswordType::class)
            ->add('confirmPassword', PasswordType::class)
            ->add('firstName')
            ->add('lastName')
            ->add('phone')
            ->add('postalCode')
            ->add('city')
            ->add('country')
            ->add('address')
            ->add('birthDate', DateType::class, [
                'years' => range(date('Y'), date('Y')-100),
                // 'months' => range(date('m'), 12),
                // 'days' => range(date('d'), 31)
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class, [
                'years' => range(1922, 2022)
            ]
        ]);
    }
}
