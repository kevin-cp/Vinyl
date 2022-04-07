<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{


    /**
     * @Route ("/list", name="app_list")
     */
    public function list(ProductRepository $repo): Response 
    {
        $products = $repo->findAll([], ['name'=>'DESC']);
        return $this->render('product/list.html.twig', compact('products'));
    }

    /**
     * @Route ("/list/price/desc", name="app_list_desc")
     */
    public function listByPriceDesc(ProductRepository $repo): Response
    {
        $products = $repo->findBy([], ['price' => 'DESC']);
        return $this->render('product/list.html.twig', compact('products'));
    }

    /**
     * @Route ("/list/price/asc", name="app_list_asc")
     */
    public function listByPriceASC(ProductRepository $repo): Response
    {
        $products = $repo->findBy([], ['price' => 'ASC']);
        return $this->render('product/list.html.twig', compact('products'));
    }

    
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