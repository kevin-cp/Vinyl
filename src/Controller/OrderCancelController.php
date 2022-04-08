<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderCancelController extends AbstractController
{
    /**
     * @Route("/stripe/error/{stripeSessionId}", name="app_order_error")
     */
    public function index(EntityManagerInterface $em, $stripeSessionId)
    {
        $order = $em->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('order_cancel/index.html.twig', [
            'order' => $order
        ]);
    }
}