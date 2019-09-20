<?php


namespace App\Bazar\ConnectDBBundle\Helpers;


use App\Bazar\ConnectDBBundle\Entity\Order\BSaleOrder;
use App\Bazar\ConnectDBBundle\Entity\Order\BSaleOrderPropsValue;
use App\Bazar\ConnectDBBundle\Entity\QKey;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * Class FullOrder
 * @package App\Bazar\ConnectDBBundle\Helpers
 */
class FullOrder extends AbstractController
{

    /**
     * @var string
     */
    private $orderToken,
            $phone;

    /**
     * @var BSaleOrder
     */
    private $fullOrder;

    /**
     * @var QKey
     */
    private $keys;
    private $products;


    /**
     * FullOrder constructor.
     * @param string $orderToken
     * @param string $phone
     */
    public function __construct(string $orderToken='', string $phone='')
    {
        $this->orderToken = $orderToken;
        $this->phone = $phone;
        $this->fullOrder = $this->getDoctrine()
            ->getRepository(BSaleOrder::class)
            ->find($this->getDoctrine()
                ->getRepository(BSaleOrderPropsValue::class)
                ->findBy(['code' => ['PHONE', '	TOKEN'], 'value' => [$orderToken, $phone]]));
    }


}