<?php
namespace App\EventSubscriber;

use App\Repository\CompanyRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

//use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use Symfony\Component\Security\Http\Util\TargetPathTrait;

class InitialDataSubscriber implements EventSubscriberInterface
{
    use TargetPathTrait;
    
    //private $params;
    private $repoCompany;

    //ParameterBagInterface $params -> read yaml parameters services.yml
    public function __construct(CompanyRepository $repoCompany)
    {
      //$this->params = $params;
      $this->repoCompany = $repoCompany;

    }    

    public function onKernelRequest(RequestEvent $event)
    {
      $request = $event->getRequest();

      if ($request->isXmlHttpRequest()) return;
      
      //---------------Set initial values------------------------------------------------------------------------------
      //if(!$request->getSession()->get('appParam')) 
      $request->getSession()->set('appParam', $this->repoCompany->find(1));
      //---------------------------------------------------------------------------------------------------------------

      $this->saveTargetPath($request->getSession(), 'main', $request->getUri());
    
    }

    public static function getSubscribedEvents()
    {
      return [
        KernelEvents::REQUEST => ['onKernelRequest'],
      ];
    }
    
}