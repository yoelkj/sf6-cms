<?php

namespace App\Twig;

use App\Entity\Agency;
use App\Entity\Gallery;
use App\Entity\Order;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

use Symfony\Component\Security\Core\Security;

use Doctrine\ORM\EntityManagerInterface;
use ReflectionClass;
use Twig\TwigTest;

class AppExtension extends AbstractExtension
{

    private EntityManagerInterface $em;
    private Security $security;

    public function __construct(EntityManagerInterface $em, Security $security)
    {
        $this->em = $em;
        $this->security = $security;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('class_name', array($this, 'getClassName')),
            new TwigFilter('order_descrip', array($this, 'getOrderDescriotion')),

        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('maskNumberOrder', array($this, 'maskNumberOrder')),
            new TwigFunction('maskNumberLocalOrder', array($this, 'maskNumberLocalOrder')),
            new TwigFunction('instanceof', array($this, 'isInstanceof')),
            new TwigFunction('localUrl', array($this, 'parseLocarUrl')),
            new TwigFunction('recalculeTotal', array($this, 'recalculeTotal')),
            new TwigFunction('getOrderDetailItems', array($this, 'getOrderDetailItems')),


        ];
    }

    public function getTests()
    {
        return [
            new TwigTest('instanceof', [$this, 'isInstanceof'])
        ];
    }

    public function isInstanceof($var, $instance): bool
    {

        switch ($instance) {
            case 'Agency':
                return $var instanceof Agency;
                break;
            case 'User':
                return $var instanceof Agency;
                break;
            default:
                return $var instanceof $instance;
                break;
        }
    }

    public function maskNumberLocalOrder($number, $pad_length, $pad_string)
    {
        return 'P' . substr($_ENV['APP_COMPANY'], 0, 2) . '-' . str_pad($number, $pad_length, $pad_string, STR_PAD_LEFT);
    }

    public function recalculeTotal($obj_order, $is_super_agency, $is_admin)
    {

        $total = $final_total = 0;
        $arr_detail = ($obj_order) ? $this->em->getRepository(Order::class)->getOrderActiveView($obj_order, 1) : null;

        if (isset($arr_detail['detail'])) {
            foreach ($arr_detail['detail'] as $row_detail) {

                if ($is_super_agency || $is_admin) {
                    $row_price = ($is_admin) ? $row_detail['base'] : $row_detail['parent'];
                } else {
                    $row_price = $row_detail['price'];
                }

                $total += ($row_price * $row_detail['items']);

                $final_total = $row_detail['price'] * $row_detail['items'];
            }
        }

        if ($arr_detail['head']['total'] != $final_total) {
            $obj_order->setTotal($final_total);
            $this->em->persist($obj_order);
            $this->em->flush();
        }

        return $total;
    }

    public function maskNumberOrder($number, $pad_length, $pad_string)
    {
        return 'P' . substr($_ENV['APP_COMPANY'], 0, 2) . '-' . str_pad($number, $pad_length, $pad_string, STR_PAD_LEFT);
    }

    public function getClassName($obj)
    {

        $reflect = new ReflectionClass($obj);
        $class_name = $reflect->getShortName();

        return $class_name;
    }

    public function getOrderDescriotion(Order $order)
    {
        $descrip = [];

        foreach ($order->getOrderDetails() as $row_detail) {
            $descrip[] = $row_detail->getDescription();
        }

        return implode(', ', $descrip);
    }

    public function parseLocarUrl(String $url, $agency)
    {

        $parse_url = parse_url($url);
        $host_url = (isset($parse_url['host'])) ? $parse_url['host'] : '#';

        $hostName = $_SERVER['SERVER_NAME'];

        if ($agency && $host_url && strpos($host_url, $hostName) !== false) {
            $url = (substr($url, -1) !== '/') ? $url . '/' . $agency : $url . $agency;
        }

        return $url;
    }

    public function getOrderDetailItems()
    {
        $arr_data = $this->em->getRepository(Order::class)->getOrderActiveView();
        $items = 0;

        if (isset($arr_data['detail'])) {
            foreach ($arr_data['detail'] as $key => $det) {
                $items += $det['items'];
            }
        }

        return $items;
    }
}
