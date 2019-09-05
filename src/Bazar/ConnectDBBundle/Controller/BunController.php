<?php


namespace App\Bazar\ConnectDBBundle\Controller;


use App\Bazar\ConnectDBBundle\Entity\QKey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}