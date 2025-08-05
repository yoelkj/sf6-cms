<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ForceSeoIndexSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        // Solo aplicar en entorno de producción
        $env = $_SERVER['APP_ENV'] ?? $_ENV['APP_ENV'] ?? 'dev';

        if ($env === 'prod') {
            $response = $event->getResponse();

            // Forzar indexación y seguimiento
            $response->headers->set('X-Robots-Tag', 'index, follow');
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // Prioridad baja (-255) para que se ejecute al final
            KernelEvents::RESPONSE => ['onKernelResponse', -255],
        ];
    }
}
