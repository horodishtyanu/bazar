<?php

namespace App\Bazar\ProductTokenBundle\Controller;

use App\Bazar\ConnectDBBundle\Entity\Order\BSaleOrder;
use App\Bazar\ConnectDBBundle\Entity\QKey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    protected $authTestKey = 'fe1bae27cb7c1fb823f496f286e78f1d2ae87734';
    /**
     * @Route("/tokenactivate", name="main")
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
     * @return JsonResponse
     */
    public function checkToken(Request $request)
    {
        if ($request->headers->get('auth_token') != $this->authTestKey) {
            return $this->json(['errors' => ['auth_error']], 403);
        }
//        return $this->json(['errors' => ['auth_error']], 403);

        return $this->json(['data' => ['auth_token' => $this->authTestKey]]);
    }

    /**
     * @Route("/token/auth", name="auth")
     * @param Request $request
     * @return JsonResponse
     */
    public function auth(Request $request)
    {
        $requestData = json_decode($request->getContent(), true);
        $errors = [];
        $data = [];

        if ($requestData['code'] == '12121212' && $requestData['phone'] == '71231231231') {
            $data = ['auth_token' => $this->authTestKey];
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
     * @return JsonResponse
     */
    public function products(Request $request):JsonResponse
    {
        if ($request->headers->get('auth_token') != $this->authTestKey) {
            return $this->json(['errors' => ['auth_error']], 403);
        }
        $orderRepo = $this->getDoctrine()->getRepository(BSaleOrder::class);
        $keysRepo = $this->getDoctrine()->getRepository(QKey::class);
        $keys = $keysRepo->findBy([],[], 4);
        $data = [
            'order' => $keys[0]->getOrderId(),
        ];
        foreach ($keys as $key){
            $data['items'][] = [
                'order' => $key->getOrderId(),
                'link' => $key->getDownload(),
                'name' => $key->getProduct()
            ];
        }

        return $this->json(['data' => $data]);
    }
}
