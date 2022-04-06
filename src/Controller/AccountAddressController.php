<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAddressController extends AbstractController
{
    /**
     * @Route("/account/address", name="app_account_address")
     */
    public function address(): Response
    {
        return $this->render('account/address.html.twig');
    }

    /**
     * @Route("/account/add-address", name="app_account_address_add")
     */
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $address->setUser($this->getUser());
            $em->persist($address);
            $em->flush();
            return $this->redirectToRoute('app_account_address');

        }

        return $this->render('account/address_add.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
