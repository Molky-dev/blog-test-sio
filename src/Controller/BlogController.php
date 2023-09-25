<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
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

    #[Route("/blog-grid/{category}", name: "blog_grid", defaults: ["category" => null])]
    public function blockGrid(?string $category, ArticleRepository $articleRepository, NoticeRepository $noticeRepository, CategoryRepository $categoryRepository): Response
    {
        if($category != strtolower($category)) {
            return $this->redirectToRoute("blog_fullwidth", ["category" => strtolower($category)]);
        }

        if($category) {
            $category = $categoryRepository->findBy(["slug" => $category]);
            $articles = $articleRepository->findBy(["category" => $category]);
        } else {
            $articles = $articleRepository->findAll();
        }

        return $this->render('blog/blog-grid.html.twig', [
            'articles' => $articles,
            'notice' => $noticeRepository->findAll()
        ]);
    }

    #[Route("/blog-fullwidth/{category}", name: "blog_fullwidth", defaults: ["category" => null])]
    public function blockFullwidth(?string $category, ArticleRepository $articleRepository, NoticeRepository $noticeRepository, CategoryRepository $categoryRepository): Response
    {
        if($category != strtolower($category)) {
            return $this->redirectToRoute("blog_fullwidth", ["category" => strtolower($category)]);
        }
        if($category) {
            $category = $categoryRepository->findBy(["slug" => $category]);
            $articles = $articleRepository->findBy(["category" => $category]);
        } else {
            $articles = $articleRepository->findAll();
        }

        return $this->render('blog/blog-full-width.html.twig', [
            'articles' => $articles,
            'notice' => $noticeRepository->findAll()
        ]);

    }

    public function renderCategories(CategoryRepository $categoryRepository): Response
    {
        return $this->render('blog/_categories.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }

    public function renderArticleSlider(ArticleRepository $articleRepository) : Response
    {
        return $this->render('blog/_article_slider.html.twig', [
            'articles' => $articleRepository->findBy([], ["date" => "DESC"], 3)
        ]);
    }


    public function numberOfArticleWritten(ArticleRepository $articleRepository) : Response
    {
        return $this->render('blog/_articleWritten.html.twig', [
            'numberOfArticles' => count($articleRepository->findBy([]))
        ]);
    }


}
