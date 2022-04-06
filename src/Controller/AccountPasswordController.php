<?php

namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PasswordType;

class AccountPasswordController extends AbstractController
{
    /**
     * @Route("/account/password", name="app_account_password")
     */
    public function index(): Response
    {

        $form = $this->createForm(PasswordType::class);
        $viewForm = $form->createView();

        return $this->render('account/password.html.twig', compact('viewForm'));
    }
}
 