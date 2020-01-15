<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('home/about.html.twig');
    }

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
