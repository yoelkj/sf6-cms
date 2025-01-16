<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\HttpUtils;

class SaveTargetPathListener
{
    private HttpUtils $httpUtils;
    private RequestStack $requestStack;
    private RouterInterface $router;
    private string $firewallName;

    public function __construct(HttpUtils $httpUtils, RequestStack $requestStack, RouterInterface $router, string $firewallName = 'main')
    {
        $this->httpUtils = $httpUtils;
        $this->requestStack = $requestStack;
        $this->router = $router;
        $this->firewallName = $firewallName;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        //dd($this->isPrivateRoute($request));

        // Verifica si la solicitud es para una página privada y no es la página de login

        //dd($request, $this->isPrivateRoute($request));

        if (!$this->isLoginPage($request) && !$request->getUser() && $this->isPrivateRoute($request)) {
            //dd($request);
            $this->saveTargetPath($request);
        }
    }

    private function isLoginPage(Request $request): bool
    {
        $currentLocale = $request->getLocale();
        $loginPath = $this->router->generate('app_login', ['_locale' => $currentLocale]);

        return $this->httpUtils->checkRequestPath($request, $loginPath);
    }

    private function isPrivateRoute(Request $request): bool
    {
        $path = $request->getPathInfo(); // Obtiene la ruta solicitada, e.g., /es/admin

        // Extraer la parte del idioma si existe
        if (preg_match('#^/([a-z]{2})(/.*)?$#', $path, $matches)) {
            $path = $matches[2] ?? '/'; // Si hay un idioma, toma el resto de la ruta
        }

        // Define los prefijos de las rutas privadas
        $protectedPrefixes = ['/admin', '/dashboard', '/app-cart-show', '/user', '/app-order-show'];
        foreach ($protectedPrefixes as $prefix) {
            if (str_starts_with($path, $prefix)) {
                return true;
            }
        }

        return false;
    }

    private function saveTargetPath(Request $request): void
    {
        $session = $this->requestStack->getSession(); // Obtiene la sesión desde el RequestStack
        if ($session) {
            $currentPath = $request->getUri();
            $session->set('_security.' . $this->firewallName . '.target_path', $currentPath);
            $session->set('previous_security_page', $currentPath);
        }

        //dd($session);
    }
}
