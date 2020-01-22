<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExceptionController extends AbstractController
{
    public function showAction()
    {
        return $this->render('exception/error.html.twig');
    }
}
