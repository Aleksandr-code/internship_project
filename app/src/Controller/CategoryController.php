<?php

namespace App\Controller;

use App\ResponseBuilder\CategoryResponseBuilder;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryService $categoryService,
        private CategoryResponseBuilder $categoryResponseBuilder,
    )
    {
    }

    #[Route('/api/categories', name: 'app_category_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $categories = $this->categoryService->index();

        return $this->categoryResponseBuilder->indexCategoryResponse($categories);
    }
}
