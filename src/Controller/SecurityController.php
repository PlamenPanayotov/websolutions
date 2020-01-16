<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
     /**
     * @Route("/register", name="register")
     */

    public function register()
    {
        return $this->render('security/register.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */

    public function login()
    {
        return $this->render('security/login.html.twig');
    }
}
