<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\NoticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: "blog_index")]

    public function index(): Response
    {
        return $this->render('blog/index.html.twig');
    }

    #[Route('/about', name: 'blog_about')]
    public function show(): Response
    {
        return $this->render('blog/about.html.twig');
    }

    #[Route('/404', name: 'blog_404')]
    public function notFound(): Response
    {
        return $this->render('blog/404.html.twig');
    }

    #[Route("/coming", name: "blog_coming_soon")]
    public function comingSoon(): Response
    {
        return $this->render('blog/coming-soon.html.twig');
    }

    #[Route("/blog-grid", name: "blog_grid")]
    public function blockGrid(ArticleRepository $articleRepository): Response
    {
        return $this->render('blog/blog-grid.html.twig', [
            'articles' => $articleRepository->findAll()
        ]);
    }

    #[Route("/blog-fullwidth", name: "blog_fullwidth")]
    public function blockFullwidth(ArticleRepository $articleRepository, NoticeRepository $noticeRepository): Response
    {
        return $this->render('blog/blog-full-width.html.twig', [
            'articles' => $articleRepository->findAll(),
            'notice' => $noticeRepository->findAll()
        ]);
    }

}
