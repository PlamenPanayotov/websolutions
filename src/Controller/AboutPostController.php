<?php

namespace App\Controller;

use App\Entity\AboutPost;
use App\Form\AboutPostType;
use App\Repository\AboutPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/about")
 */
class AboutPostController extends AbstractController
{
    /**
     * @Route("/", name="about_post_index", methods={"GET"})
     */
    public function index(AboutPostRepository $aboutPostRepository): Response
    {
        return $this->render('home/about.html.twig', [
            'about_posts' => $aboutPostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="about_post_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $aboutPost = new AboutPost();
        $form = $this->createForm(AboutPostType::class, $aboutPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aboutPost);
            $entityManager->flush();

            return $this->redirectToRoute('about_post_index');
        }

        return $this->render('about_post/new.html.twig', [
            'about_post' => $aboutPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="about_post_show", methods={"GET"})
     */
    public function show(AboutPost $aboutPost): Response
    {
        return $this->render('about_post/show.html.twig', [
            'about_post' => $aboutPost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="about_post_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AboutPost $aboutPost): Response
    {
        $form = $this->createForm(AboutPostType::class, $aboutPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('about_post_index');
        }

        return $this->render('about_post/edit.html.twig', [
            'about_post' => $aboutPost,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="about_post_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AboutPost $aboutPost): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aboutPost->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($aboutPost);
            $entityManager->flush();
        }

        return $this->redirectToRoute('about_post_index');
    }
}
