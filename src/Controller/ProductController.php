<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
     /**
     * @Route ("/list/details/{id}", name="app_details")
     */
    public function details($id, ProductRepository $repo) :Response
    {
        $product = $repo->find($id);
        if (!$product) {
            throw $this->createNotFoundException();
        }
        return $this->render('product/details.html.twig', compact('product'));
    }
}