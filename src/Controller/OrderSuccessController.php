<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{
    /**
     * @Route("/stripe/thanks/{CHECKOUT_SESSION_ID}", name="app_order_success")
     */
    public function index(EntityManagerInterface $em, $stripeSessionId)
    {
        $order =$this->$em->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$order) {
            return $this->redirectToRoute('app_home');
        }

        dd($order);
        return $this->render('order_success/index.html.twig');
    }
}
