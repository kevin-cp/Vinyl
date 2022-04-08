<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{
    /**
     * @Route("/stripe/thanks/{stripeSessionId}", name="app_order_success")
     */
    public function index(EntityManagerInterface $em, $stripeSessionId)
    {
        $order = $em->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        if(!$order->getIsPaid()) {
            $order->setIsPaid(1);
            $em->flush();
        }

        return $this->render('order_success/index.html.twig', [
            'order' => $order
        ]);
    }
}