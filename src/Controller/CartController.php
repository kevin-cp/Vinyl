<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route ("/cart", name="app_cart")
     */
    public function cart(Cart $cart, ProductRepository $repo): Response
    {
        $cartContent = [];

        foreach ($cart->get() as $id => $quantity) {
            $cartContent[] = [
                'product' =>  $repo->find($id),
                'quantity' => $quantity,
            ];
        }

          return $this->render('cart/index.html.twig', [
              'cart' => $cartContent
          ]);
    }

    /**
     * @Route ("/cart/add/{id}", name="app_add_cart")
     */
    public function add($id, Cart $cart): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('app_cart');
    }

    /**
     * @Route ("/cart/remove", name="app_remove_cart")
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('app_home');
    }

    /**
     * @Route ("/cart/delete/{id}", name="app_delete_cart")
     */
    public function delete($id, Cart $cart): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('app_cart');
    }
}
