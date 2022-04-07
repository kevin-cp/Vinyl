<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class PasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'disabled' => true
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'disabled' => true
            ])
            ->add('email', EmailType::class, [
                'disabled' => true
            ])
//            ->add('password', PasswordType::class, [
//                'label' => 'Mon mot de passe actuel',
//                'attr' => [
//                    'placeholder' => 'Veuillez renseigner votre mot de passe'
//                ]
//            ])
//            ->add('new_password', RepeatedType::class, [
//                'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques',
//                'mapped' => false,
//                'constraints' => new Length([
//                   'min' => 6,
//                   'max' => 30,
//               ]),
//                'label' => 'Mon nouveau mot de passe',
//                'required' => true,
//                'first_options' => [
//                    'label' => 'Nouveau Mot de passe',
//                    'attr' => [
//                        'placeholder' => 'Merci de saisir votre nouveau mot de passe.'
//                    ]
//                   ],
//                'second_options' => [
//                    'label' => 'Confirmez votre nouveau mot de passe',
//                    'attr' => [
//                       'placeholder' => 'Merci de confirmer votre nouveau mot de passe.'
//                       ]
//                    ]
//           ])
           ->add('submit', SubmitType::class, [ 
            'label' => "Mettre à jour"
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
