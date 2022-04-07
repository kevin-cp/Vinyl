<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Form\OrderType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="app_order")
     */
    public function index(Cart $cart, Request $request): Response
    {
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()]);

        return $this->render('order/index.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }

    /**
     * @Route("/order/summary", name="app_order_summary")
     */
    public function summary(Cart $cart, Request $request, EntityManagerInterface $em): Response
    {
    
        $form = $this->createForm(OrderType::class, null, [
            'user' => $this->getUser()]);

        $form->handleRequest($request);

                $date = new DateTimeImmutable();
                $carriers = $form->get('carrier')->getData();
                $delivery = $form->get('addresses')->getData();
                $delivery_content = $delivery->getFirstname().''.$delivery->getLastname();
                $delivery_content .= '<br />' .$delivery->getPhone();
                $delivery_content .= '<br />' .$delivery->getAddress();
                $delivery_content .= '<br />' .$delivery->getPostal().''.$delivery->getCity();
                $delivery_content .= '<br />' .$delivery->getCountry();


            if($form->isSubmitted() && $form->isValid()) {

                $order = new Order();
                $order->setUser($this->getUser());
                $order->setCreatedAt($date);
                $order->setCarrierName($carriers->getName());
                $order->setCarrierPrice($carriers->getPrice());
                $order->setDelivery($delivery_content);
                $em->persist($order);

                foreach ($cart->getFull() as $product) {
                    $orderDetails = new OrderDetails();
                    $orderDetails->setMyOrder($order);
                    $orderDetails->setProduct($product['product']->getAlbumName());
                    $orderDetails->setQuantity($product['quantity']);
                    $orderDetails->setPrice($product['product']->getPrice());
                    $orderDetails->setTotal($product['product']->getPrice() * $product['quantity']);
                    $em->persist($orderDetails);
                }

                $em->flush();

                return $this->render('order/order_summary.html.twig', [
                'form' => $form->createView(),
                'cart' => $cart->getFull(),
                'delivery' => $delivery_content,
                    'order' => $order
                ]); 
            }

        return $this->redirectToRoute('app_cart');
    }
}
