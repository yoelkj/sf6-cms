<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends BaseController
{
    #[Route('/api/me', name: 'app_ajax_user_detail')]
    #[IsGranted('IS_AUTHENTICATED_REMEMBERED')]
    public function apiMe(): Response
    {   

        /*
        $this->denyAccessUnlessGranted('ROLE_USER');
        if ($question->getOwner() !== $this->getUser()) {
            throw $this->createAccessDeniedException('You are not the owner!');
        }
        */    

        //$this->denyAccessUnlessGranted('SHOW', $this->getUser());

        return $this->json($this->getUser(), 200, [], [
            'groups' => ['user:read']
        ]);
    }

}
