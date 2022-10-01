<?php
namespace App\EventSubscriber;

use App\Repository\CompanyRepository;
use App\Repository\CountryRepository;
use App\Repository\LanguageRepository;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouterInterface;

class LocaleSubscriber implements EventSubscriberInterface
{
    //private $params;
    private $repoCountry;
    private $repoLanguage;
    private $repoCompany;
    private $appKernel;

    private RouterInterface $router;

    //ParameterBagInterface $params -> read yaml parameters services.yml
    public function __construct(RouterInterface $router, CompanyRepository $repoCompany, LanguageRepository $repoLanguage, CountryRepository $repoCountry, KernelInterface $appKernel)
    {
        
      //$this->params = $params;
      $this->repoCompany = $repoCompany;
      $this->repoCountry = $repoCountry;
      $this->repoLanguage = $repoLanguage;
      $this->appKernel = $appKernel;

      $this->router = $router;

    }    

    public function onKernelRequest(RequestEvent $event)
    {

      $request = $event->getRequest();
      $routeName = $request->attributes->get('_route');

      if($request->attributes->get('_locale')) return;
      
      //||!$request->hasPreviousSession()
      if ($routeName != 'app_homepage' || $request->isXmlHttpRequest() ) return;
      
      if($routeName == 'app_homepage'){

        $arr_default_locale = $this->getDefaultLocales(); //get default company language and available languages
        
        $client_ip = null;//$request->getClientIp();
        $arr_locale_byip = $this->getLocationInfoByIp($client_ip);

        //Get country language from ip
        $selected_language = $this->repoCountry->findOneByCode($arr_locale_byip['country'])?->getLanguage()?->getCode();
        
        $selected_language = ($selected_language) ? $selected_language : $arr_default_locale['language'];

        if($arr_locale_byip['continent'] != 'South America') $selected_language = 'en';
        
        if($arr_locale_byip['country'] == 'ES') $selected_language = 'es';
        if($arr_locale_byip['country'] == 'MX') $selected_language = 'es';
        
        //Set selected language
        $request->setLocale($selected_language);

        
        //Redirect locale routes
        //$response = new RedirectResponse($this->router->generate('app_homepage_local', ['_locale' => $request->getLocale()]));
        //$event->setResponse($response);

      }

    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }

    public function getDefaultLocales(){
      
      $arr_result = [];

      $obj_company = $this->repoCompany->find(1);
      $obj_languages = $this->repoLanguage->getRows(1);
      
      $language = ($obj_company)? $obj_company->getLanguage()->getCode() : 'es';

      $arr_result['language'] = $language;
      foreach($obj_languages as $row) $arr_result['languages'][$row->getId()] = $row->getCode();

      //dd($arr_result);

      return $arr_result;

    }

    public function getLocationInfoByIp($client_ip = null){

        $reader = null;
        $GeoLiteDatabasePath = $this->appKernel->getProjectDir().'/private/geolite2-city/GeoLite2-City.mmdb';  

        try {
          $reader = new Reader($GeoLiteDatabasePath);
        } catch (AddressNotFoundException $ex) {
          throw new Exception('Invalid source localization');
        }

        $ip_address = ($client_ip && ($client_ip != '127.0.0.1' && $client_ip != '::1')) ? $client_ip : $this->getUserIP();
        
        $localization = $reader->city($ip_address);
        
        $obj_country = $localization->country;
        $arr_continent_names = (isset($localization->continent->names))?$localization->continent->names:'';
    
        $result['country'] = $obj_country->isoCode;
        $result['country_name'] = (isset($obj_country->names['en']))?$obj_country->names['en']:'';
        $result['continent'] = (isset($arr_continent_names['en']))?$arr_continent_names['en']:'';

        return $result;
    }

    public function getUserIP()
		{

      $ip = null;

      //Filter Ip
			if (getenv('HTTP_CLIENT_IP')) $ip =  (filter_var(getenv('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP))?getenv('HTTP_CLIENT_IP'):null;
			elseif (getenv('HTTP_X_FORWARDED_FOR')) $ip =  (filter_var(getenv('HTTP_X_FORWARDED_FOR'), FILTER_VALIDATE_IP))?getenv('HTTP_X_FORWARDED_FOR'):null;
			elseif (getenv('HTTP_X_FORWARDED')) $ip =  (filter_var(getenv('HTTP_X_FORWARDED'), FILTER_VALIDATE_IP))?getenv('HTTP_X_FORWARDED'):null;
			elseif (getenv('HTTP_FORWARDED_FOR')) $ip = (filter_var(getenv('HTTP_FORWARDED_FOR'), FILTER_VALIDATE_IP))?getenv('HTTP_FORWARDED_FOR'):null;
			elseif (getenv('HTTP_FORWARDED')) $ip = (filter_var(getenv('HTTP_FORWARDED'), FILTER_VALIDATE_IP))?getenv('HTTP_FORWARDED'):null;

      //Test local ip
      if($_SERVER['REMOTE_ADDR'] == '127.0.0.1' || $_SERVER['REMOTE_ADDR'] == '::1') $ip = "179.6.72.98";

      //Set defaul ip
      if(!$ip) $ip = $_SERVER['REMOTE_ADDR'];


			//$ip = "80.28.108.121"; // ES
			//$ip = "95.18.66.221"; // ES
      //$ip = "80.18.120.118"; // IT
      //$ip = "213.89.37.0"; // SE
      //$ip = "79.93.164.80";//FR
      //$ip = "81.39.38.239";//CANARIAS
			//$ip = "85.214.132.117";//GE
      //$ip = "148.201.255.255";//MX
      //$ip = "77.54.255.255";//PT
      //$ip = "200.52.95.170";//MX
      //$ip = "108.75.193.108";//USA	  
      $ip = "179.6.72.98";//PE	  

			return $ip;
		}
}