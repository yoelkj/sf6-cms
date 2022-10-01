<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;
use Symfony\Contracts\Translation\TranslatorInterface;

use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, VerifyEmailHelperInterface $verifyEmailHelper): Response
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
            
            $signatureComponents = $verifyEmailHelper->generateSignature(
                'app_verify_email',
                $user->getId(),
                $user->getEmail(),
                ['id' => $user->getId()]
            );

            // Send signatureComponents as an email!
            
            $this->addFlash('success', 'Confirm your email at: '.$signatureComponents->getSignedUrl());


            /*
            //UserAuthenticatorInterface $userAuth, FormLoginAuthenticator $formLoginAuth,
            $userAuth->authenticateUser(
                $user,
                $formLoginAuth,
                $request
            );
            */

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route("/verify", name:"app_verify_email")]
    public function verifyUserEmail(Request $request, EntityManagerInterface $entityManager, VerifyEmailHelperInterface $verifyEmailHelper, UserRepository $user_repo): Response
    {
        $user = $user_repo->find($request->query->get('id'));
        if (!$user) {
            throw $this->createNotFoundException();
        }

        try {

            $verifyEmailHelper->validateEmailConfirmation(
                $request->getUri(),
                $user->getId(),
                $user->getEmail(),
            );

        } catch (VerifyEmailExceptionInterface $e) {
            
            $this->addFlash('error', $e->getReason());
            return $this->redirectToRoute('app_register');

        }


        $user->setIsVerified(true);
        $entityManager->flush();
        $this->addFlash('success', 'Account Verified! You can now log in.');
        return $this->redirectToRoute('app_login');

    }

    #[Route("/verify/resend", name:"app_verify_resend_email")]
    public function resendVerifyEmail()
    {
        return $this->render('registration/resend_verify_email.html.twig');
    }
}
