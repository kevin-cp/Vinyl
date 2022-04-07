<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="app_home")
     */
    public function home(ProductRepository $repo, Cart $cart): Response
    {
        $products = $repo->findBy([], [], 3);
        return $this->render('home/home.html.twig', compact('products', 'cart'));
    }

}