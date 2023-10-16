<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


#[Route('/oldapi/v1', name: 'api_')]
class APIController extends AbstractController {

    #[Route('/article/all', name: 'all_articles', methods: ['GET'])]
    public function getAll(ArticleRepository $articleRepository, SerializerInterface $serializer): JsonResponse
    {

        $articles = $articleRepository->findAll();
        $result = $serializer->serialize($articles, 'json', ["groups" => "article"]);
        return $this->json($result,Response::HTTP_OK);

    }

    #[Route('/article/{id}', name: 'article_by_id', methods: ['GET'])]
    public function getArticleById(int $id, ArticleRepository $articleRepository, SerializerInterface $serializer) : JsonResponse {
        $article = $articleRepository->findBy(["id" => $id]);
        $result = $serializer->serialize($article, 'json', ["groups" => "article"]);
        return $this->json($result, Response::HTTP_OK, ["groups" => "article"]);
    }

}
