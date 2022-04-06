<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\CarrierRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{

    /**
     * @Route ("/order", name="app_order")
     */
    public function delivery(Cart $cart, Request $request): Response
    {


        $form = $this->createForm(OrderType::class);

        return $this->render('order/order.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }


}
