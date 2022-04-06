<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\CarrierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route ("/delivery", name="app_delivery")
     */
    public function delivery(CarrierRepository $repo, Cart $cart): Response
    {
        $carriers = $repo->findAll();


        return $this->render('order/order.html.twig', [
            'carriers' => $carriers,
            'cart' => $cart->getFull()
        ]);
    }
}
