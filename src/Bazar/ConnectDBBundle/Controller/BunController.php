<?php


namespace App\Bazar\ConnectDBBundle\Controller;


use App\Bazar\ConnectDBBundle\Entity\Basket\BSaleBasket;
use App\Bazar\ConnectDBBundle\Entity\Order\BSaleOrder;
use App\Bazar\ConnectDBBundle\Entity\Order\BSaleOrderPropsValue;
use App\Bazar\ConnectDBBundle\Entity\QKey;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BunController extends AbstractController
{

    /**
     * @Route(path="/testBun", methods={"GET"})
    **/
    public function indexAction():Response
    {
        $repo = $this->getDoctrine()->getRepository(QKey::class);
        $res = $repo->findBy(['distributor' => '9723023366', 'status' => 0]);
        return $this->json($res);
    }

    /**
     * @Route(path="/orders")
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function getOrders(EntityManagerInterface $em)
    {
        $orderRepo = $this->getDoctrine()->getRepository(BSaleOrder::class);
        $results = $orderRepo->findBy([],[], 3);
        array_map(function ($result) use ($em){
            $result->setOrderPropsValue($this->getDoctrine()->getRepository(BSaleOrderPropsValue::class)->findBy(['orderId'=>$result->getId()]));
        }, $results);
        dd($results[1]);
        return $this->json($results);
    }

    /**
     * @param $orderId
     * @return JsonResponse
     */
    public function getBasket($orderId)
    {
        $basketRepo = $this->getDoctrine()->getRepository(BSaleBasket::class);
        $result = $basketRepo->findByOrderId($orderId);
        return $this->json($result);
    }
}