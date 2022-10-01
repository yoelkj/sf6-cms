<?php

namespace App\EventSubscriber;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class HideActionSubscriber implements EventSubscriberInterface
{
    public function onBeforeCrudActionEvent(BeforeCrudActionEvent $event): void
    {
        if (!$adminContext = $event->getAdminContext()) {
            return;
        }
        if (!$crudDto = $adminContext->getCrud()) {
            return;
        }

        if ($crudDto->getEntityFqcn() !== User::class) {
            return;
        }

        // disable action entirely delete, detail, edit
        $user = $adminContext->getEntity()->getInstance();
        if ($user instanceof User && $user->isIsActive()) {
            $crudDto->getActionsConfig()->disableActions([Action::DELETE]);
        }

        // This gives you the "configuration for all the actions".
        // Calling ->getActions() returns the array of actual actions that will be
        // enabled for the current page... so then we can modify the one for "delete"
        $actions = $crudDto->getActionsConfig()->getActions();
        if (!$deleteAction = $actions[Action::DELETE] ?? null) {
            return;
        }

        $deleteAction->setDisplayCallable(function(User $question) {
            return !$question->isIsActive();
        });

    }

    public static function getSubscribedEvents(): array
    {
        return [
        //    BeforeCrudActionEvent::class => 'onBeforeCrudActionEvent',
        ];
    }
}
