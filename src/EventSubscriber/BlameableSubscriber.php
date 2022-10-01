<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class BlameableSubscriber implements EventSubscriberInterface
{
    private Security $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function onBeforeEntityUpdatedEvent(BeforeEntityUpdatedEvent $event): void
    {
        $user = $event->getEntityInstance();
        if (!$user instanceof User) {
            return;
        }
        $user = $this->security->getUser();
        
        // We always should have a User object in EA
        if (!$user instanceof User) {
            throw new \LogicException('Currently logged in user is not an instance of User?!');
        }

        
        //Save to active when update user in easyadmin
        $user->setIsActive(true);


    }

    public static function getSubscribedEvents(): array
    {
        return [
            //BeforeEntityUpdatedEvent::class => 'onBeforeEntityUpdatedEvent',
        ];
    }
}
