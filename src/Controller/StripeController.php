<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StripeController extends AbstractController
{
    /**
     * @Route("/stripe/{reference}", name="app_stripe")
     */
    public function index(EntityManagerInterface $em, Cart $cart, $reference)
    {
        $products_for_stripe = [];
        $YOUR_DOMAIN = 'http://127.0.0.1:8000';

        $order = $em->getRepository(Order::class)->findOneBy(['reference' => $reference]);

        if (!$order) {
            new JsonResponse(['error' => 'order']);
        }

        foreach ($order->getOrderDetails()->getValues() as $product) {
            $product_object = $em->getRepository(Product::class)->findOneBy(['author' => $product->getProduct()]);
            $products_for_stripe[]= [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $product->getPrice(),
                    'product_data' => [
                        'name' => $product->getProduct(),
                       
                    ],
                ],
                'quantity' => $product->getQuantity(),
            ];
        }

        $products_for_stripe[]= [
            'price_data' => [
                'currency' => 'eur',
                'unit_amount' => $order->getCarrierPrice(),
                'product_data' => [
                    'name' => $order->getCarrierName(),
                    'images' => [$YOUR_DOMAIN],
                ],
            ],
            'quantity' => $product->getQuantity(),
        ];

        
        Stripe::setApiKey($this->getParameter('stripeSK'));

        $checkout_session = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                $products_for_stripe
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/stripe/thanks/{CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . '/stripe/error/{CHECKOUT_SESSION_ID}',
        ]);

        $order->setStripeSessionId($checkout_session->id);
        $em->flush();


        $response = new JsonResponse(['id' => $checkout_session->id]);
        return $response;
    }
}
