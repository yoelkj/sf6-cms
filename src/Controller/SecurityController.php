<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;
use Endroid\QrCode\Builder\Builder;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends BaseController
{
    #[Route('/{_locale}/login', name: 'app_login')]
    public function login(Request $request, AuthenticationUtils $auth_utils): Response
    {
        //dd($request->headers->get('referer'));
        return $this->render('security/login.html.twig', [
            'error' => $auth_utils->getLastAuthenticationError(),
            'last_username' => $auth_utils->getLastUsername(),
        ]);
    }

    #[Route("/logout", name: 'app_logout')]
    public function logout()
    {
        throw new \Exception('logout() should never be reached');
    }

    #[Route("/authentication/2fa/enable", name: "app_2fa_enable")]
    #[IsGranted('ROLE_USER')]
    public function enable2fa(TotpAuthenticatorInterface $totpAuthenticator, EntityManagerInterface $em)
    {
        $user = $this->getUser();
        if (!$user->isTotpAuthenticationEnabled()) {
            $user->setTotpSecret($totpAuthenticator->generateSecret());
            $em->flush();
        }

        return $this->render('security/enable2fa.html.twig');
    }

    #[Route("/authentication/2fa/qr-code", name: "app_qr_code")]
    #[IsGranted('ROLE_USER')]
    public function displayGoogleAuthenticatorQrCode(TotpAuthenticatorInterface $totpAuthenticator)
    {
        $qrCodeContent = $totpAuthenticator->getQRContent($this->getUser());
        $result = Builder::create()
            ->data($qrCodeContent)
            ->build();

        return new Response($result->getString(), 200, ['Content-Type' => 'image/png']);
    }
}
