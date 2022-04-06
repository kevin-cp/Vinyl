<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="app_order")
     */
    public function index(Cart $cart): Response
    {
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()]);
        return $this->render('order/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
