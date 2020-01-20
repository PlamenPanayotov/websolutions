<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $contactForm = $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);
        
        if($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contactFormData = $contactForm->getData();

            $message = (new \Swift_Message('You got mail'))
            ->setFrom($contactFormData['email'])
            ->setTo('panayotov@websolutions-bg.com')
            ->setBody(
                $contactFormData['message'],
                'text/plain'
            );
            $mailer->send($message);
            $this->addFlash('primary', 'Message sent successfully');
            return $this->redirectToRoute('contact');
    }
    return $this->render('contact/contact.html.twig', [
        'contact' => $contactForm->createView()
    ]);
    }
}