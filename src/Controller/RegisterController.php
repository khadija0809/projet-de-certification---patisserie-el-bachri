<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Classe\Search;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $entityManager; // insert le manager de doctrine

    public function __construct(EntityManagerInterface $entityManager){// constrire la fonction contruit et inject l'EntityManagerInterfacge et le nom variable $entitymanader
        $this->entityManager = $entityManager;
    }

    #[Route('/register', name: 'register')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher, MailerInterface $mailer): Response 
    {
        $user = new User();// instancier la classe user
        $form = $this->createForm(RegisterType::class, $user);// instancier le form avec la methode createForm et qui prend deux paramètre la classe RegisterType et $user(les data a l'objet) 

        $form->handleRequest($request);//permet de gérer le traitement de la saisie du formulaire

        if ($form->isSubmitted() && $form->isValid()) { //qui permet de savoir si le formulaire a été saisi et 
                                                         // si de plus les règles de validations sont vérifiées ($form->isValid()) 

                   $user->setPassword(
                   $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $this->entityManager->persist($user);// persist = fige la data car on a besoin de l'enregistré  
            $this->entityManager->flush(); // execute la persistance (tu prend l'object que tu as persister et tu l'enregistre a bbd)
            
            // $email = (new TemplatedEmail())
            //     ->from($user->getEmail())
            //     ->to('patisserieelbachri@gmail.com')
            //     ->subject('Merci pour votre inscription!')
            //     ->htmlTemplate('emails/register.html.twig')
            //     ->context([
            //         'user' => $user
            //     ]);
                
            // $mailer->send($email);
            $this->addFlash(
                'success',
                'Votre compte a bien été crée'
            ); 

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/index.html.twig', [ // passer le formulaire en variable a mon template 
            'form' => $form->createView(), // creation de la vue
        ]);
       
    }
}