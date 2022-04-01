<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true, // permettre que l'utilisateur ne peux pas changer son email
                'label' => 'Mon adresse email'
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true, // permettre que l'utilisateur ne peux pas changer son prenom
                'label' => 'Mon prénom'
            ])
            ->add('lastname', TextType::class, [
                'disabled' => true,// permettre que l'utilisateur ne peux pas changer son nom
                'label' => 'Mon nom'
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Mon mot de passe actuel',
                'mapped' => false,//n'essaye pas de liée ce champs avec mon entity  
                'attr' => [
                    'placeholder' => ' Saisie votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'constraints'=> [
                    new Regex([
                        'pattern' =>"/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/",
                        'message' => 'Renseignez au moins 1 majuscule, 1 minuscule et 1 chiffre'
                    ])
                ],
                'label' => 'Nouveau mot de passe',
                'required' => true,
                'first_options' => [
                    'label' => ' Nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'saisie votre nouveau mot de passe.'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation votre nouveau mot de passe',
                    'attr' => [
                        'placeholder' => 'confirmez votre nouveau mot de passe.' 
                    ]
                ]
               
            ])
            ->add('submit',SubmitType::class, [
                'label' => "Mettre à jour mes modifications",
                'attr' => [
                    'class' => 'btn btn-dark btn-sm'
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
