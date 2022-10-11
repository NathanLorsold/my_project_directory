<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\JWTService;
use App\Service\SendMailService;
use Symfony\Component\Mime\Email;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager, SendMailService $mail, JWTService $jwt): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $this ->addFlash(
                "success",
                "Votre inscription a été crée avec succès !"
            );

            // do anything else you need here, like send an email

            //On génère le JWT de l'utilisateur
            //On crée le Header
            $header = [
                "typ" =>"JWT",
                "alg" =>"HS256"
            ];

            //On crée le Payload
            $payload = [
                "user_id" => $user->getId()
            ];

            //On génère le token
            $token = $jwt->generate($header, $payload, $this->getParameter("app.jwtsecret"));

            //dd($token);
            //On envoie un mail
            $mail->send(
                "no-reply@monsite.net",
                $user->getEmail(),
                "Activation de votre compte sur le site e-commerce",
                "register",
                    compact("user", "token")
            );
        

            return $this->redirectToRoute("app_register");

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );


        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route("/verif/{token}", name: "verify_user")]
    public function verifyUser($token, JWTService $jwt, UserRepository $userRepository, EntityManagerInterface $em): Response
    {
        dd($jwt->isValid($token));
        // //On vérifie si le token est valide, n'a pas expiré et n'a pas été modifié    
        // if($jwt->isValid($token) && !$jwt->isExpired($token) &&
        // $jwt->check($token, $this->getParameter("app.jwtsecret"))){
        //     //On récupère le payload
        //     $payload = $jwt->getPayload($token);

        //     //On récupère le user du token
        //     $user = $usersRepository->find($payload["user_id"]);

        //     //On vérifie que l'utilisateur existe et n'a pas encore activé son compte
        //     if($user && !$user->getIsVerified()){
        //         $user->setIsVerified(true);
        //         $em->flush($user);
        //         $this->addFlash("success", "Utilisateur activé");

        // return $this->redirectToRoute("app_login");
        //     }
        // }
        // //Ici un problème se pose dans le token
        // $this->addFlash("Danger", "Le token est invalide ou a expiré");

        // return $this->redirectToRoute("app_register");
}
// #[Route("/renvoiverif", name: "resend_verif")]
// public function resendVerif(JWTservice $jwt, SendMailService $mail, UserRepository $userRepository): Response
// {
//     $user = $this->getUser();

//     if(!$user){
//         $this->addFlash("Danger", "Vous devez être connecté pour accéder à cette page");

//         return $this->redirectToRoute("app_login");
//     }

//     if($user ->getIsVerified()){
//         $this->addFlash("Warning", "Cet utilisateur est déjà activé");

//         return $this->redirectToRoute("app_products_index");
//     }
//             //On génère le JWT de l'utilisateur
//             //On crée le Header
//             $header = [
//                 "typ" => "HS256",
//                 "alg" => "JWT",
//             ];

//             //On crée le Payload
//             $payload = [
//                 "user_id" => $user->getId()
//             ];

//             //On génère le token
//             $token = $jwt->generate($header, $payload, $this->getParameter("app.jwtsecret"));

//             //dd($token);
//             //On envoie un mail
//             $mail->send(
//                 "no-reply@monsite.net",
//                 $user->getEmail(),
//                 "Activation de votre compte sur le site e-commerce",
//                 "register",
//                     compact("user", "token")
//             );
//             $this->addFlash("success", "Email de vérification envoyé");

//             return $this->redirectToRoute("app_products_index");
    
// }
 }
