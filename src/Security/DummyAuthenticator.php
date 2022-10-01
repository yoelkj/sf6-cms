<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class DummyAuthenticator extends AbstractAuthenticator implements AuthenticationEntryPointInterface
{
    use TargetPathTrait;
    private UserRepository $user_repo;
    private RouterInterface $router;
    
    public function __construct(UserRepository $user_repo, RouterInterface $router)
    {
        $this->user_repo = $user_repo;
        $this->router = $router;
    }

    public function supports(Request $request): ?bool
    {
        return false;
        //return $request->getPathInfo() === '/'.$request->getLocale().'/login' && $request->isMethod('POST');
    }

    public function authenticate(Request $request): Passport
    {
        /*
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        return new Passport(
            new UserBadge($email, function($user_ident){
                $user = $this->user_repo->findOneBy([
                    'email' => $user_ident
                ]);

                
                if(!$user){
                    throw new UserNotFoundException();
                }

                
                return $user;
            }), 
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge(
                    'authenticate',
                    $request->request->get('_csrf_token')
                ),
                (new RememberMeBadge())->enable(),
            ]
        );
        */
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        /*
        if ($target = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($target);
        }
        
        return new RedirectResponse(
            $this->router->generate('app_homepage')
        );
        */
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        /*
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        return new RedirectResponse(
            $this->router->generate('app_login')
        );
        */
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        dd('Dummyauthenticator Start');
        /*
        return new RedirectResponse(
            $this->router->generate('app_login')
        );
        */
    }
}