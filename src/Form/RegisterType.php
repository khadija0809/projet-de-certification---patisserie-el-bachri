<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname',TextType::class, [ // ajouter le type d'input et je passe un tableau avec des valeurs
            'label' => 'Prénom',
            'constraints' => new Length([
                'min'=> 2,
                'max'=> 30
            ]),
            'attr' => [
                'placeholder' => 'saisie votre prénom'
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Nom',
            'constraints' => new Length([
                'min'=> 2,
                'max'=> 55
            ]),

            'attr' => [
                'placeholder' => ' Votre Nom'
            ]

        ])
        ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => new Length([
                    'min'=> 2,
                    'max'=> 60
                ]),

                'attr' => [
                    'placeholder' => 'Votre Email'
                ]

            ])

        ->add('password', RepeatedType::class, [ //permet de generer deux champs different qui doivent avoir le meme contenu 
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
            'constraints'=> [
                new Regex([
                    'pattern' =>"/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/",
                    'message' => 'Renseignez au moins 1 majuscule, 1 minuscule et 1 chiffre'
                ])
            ],
            'label' => 'Mot de passe',
            'required' => true,//champs obligatoire
            'first_options' => [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'saisie votre mot de passe.'
                ]
            ],
            'second_options' => [
                'label' => 'Confirmation mot de passe',
                'attr' => [
                    'placeholder' => 'confirmez votre mot de passe.' 
                ]
               
            ]
            
           
        ])
      
        ->add('submit',SubmitType::class, [
            'label' => "Créer un compte",
            'attr' => [
                'class' => 'btn btn-dark'
            ]
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
