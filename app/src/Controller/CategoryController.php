<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class CategoryController extends AbstractController
{
    #[Route('/api/categories', name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository, SerializerInterface $serializer): JsonResponse
    {
        $categories = $categoryRepository->findAll();
        $jsonCategories = $serializer->serialize($categories, 'json', ['groups' => ['category:list']]);

        return $this->json([
            'categories' => $jsonCategories,
        ]);
    }
}
