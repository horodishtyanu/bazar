<?php

namespace App\Bazar\ProductTokenBundle\Controller;

use App\Bazar\ConnectDBBundle\Entity\Order\BSaleOrder;
use App\Bazar\ConnectDBBundle\Entity\QKey;
use App\Bazar\ConnectDBBundle\Helpers\Crypter;
use App\Bazar\ConnectDBBundle\Helpers\Order;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    protected $authKey;
    private $cryptoKey = 'QH9O9v9D';
    /**
     * @Route("/lk", name="main")
     */
    public function index()
    {
        return $this->render('tokenActivate/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/token/checkToken", name="checkToken")
     * @param Request $request
     * @param SessionInterface $session
     * @return JsonResponse
     */
    public function checkToken(Request $request, SessionInterface $session)
    {
        if ($request->headers->get('auth_token') != $session->get('authKey')) {
            return $this->json(['errors' => ['auth_error']], 403);
        }
//        return $this->json(['errors' => ['auth_error']], 403);

        return $this->json(['data' => ['auth_token' => $session->get('authKey')]]);
    }

    /**
     * @Route("/token/auth", name="auth")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param SessionInterface $session
     * @return JsonResponse
     * @throws \Exception
     */
    public function auth(Request $request, EntityManagerInterface $em, SessionInterface $session)
    {
        $requestData = json_decode($request->getContent(), true);
        $errors = [];
        $data = [];
        $orderClass = new Order($em);
        $preOrder = $orderClass->getByProp(['code' => 'TOKEN', 'value' => $requestData['code']]);
        $order = $orderClass->getByProp(['code' => 'PHONE', 'value' => $requestData['phone'], 'orderId' => $preOrder->getId()]);

        if ($order != '') {
            $crypter = new Crypter($this->cryptoKey);
            $this->authKey = $crypter->encrypt($order->getId());
            $data = ['auth_token' => $this->authKey];
            $session->set('authKey', $this->authKey);
        } else {
            $errors[] = 'login error';
        }

        if (count($errors)) {
            return $this->json(['errors' => $errors], 403);
        }

        return $this->json(['data' => $data]);
    }

    /**
     * @Route("/token/products", name="products")
     * @param Request $request
     * @param SessionInterface $session
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function products(Request $request, SessionInterface $session, EntityManagerInterface $em):JsonResponse
    {
        $crypt = new Crypter($this->cryptoKey);
        $key = $session->get('authKey');
        $orderId = $crypt->decrypt($key);
        if ($request->headers->get('auth_token') != $key) {
            return $this->json(['errors' => ['auth_error']], 403);
        }
        $order = new Order($em);
        $order = $order->getById($orderId);
        $items = $order->basket;
        $data = [
            'order' => $order->getId(),
        ];
        foreach ($items as $item){
            $data['items'][] = [
                'order' => $item->getProductXmlId(),
                'link' => $item->getBasePrice(),
                'name' => $item->getName()
            ];
        }

        return $this->json(['data' => $data]);
    }


    /**
     * @Route(path="/choice", name="choice")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function choice(Request $request, SessionInterface $session)
    {

        //        $crypt = new Crypter($this->cryptoKey);
//        $key = $session->get('authKey');
//        $orderId = $crypt->decrypt($key);
//        if ($request->headers->get('auth_token') != $key) {
//            return $this->json(['errors' => ['auth_error']], 403);
//        }
        return $this->render("tokenActivate/choice.html.twig");
    }
}
