<?php

namespace App\ResponseBuilder;

use App\Resource\CategoryResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryResponseBuilder
{
    public function __construct(private CategoryResource $categoryResource)
    {
    }

    public function indexCategoryResponse(array $categories, $status = 200, $headers = [], $isJson = true):JsonResponse
    {
        $categoryResource = $this->categoryResource->categoryListCollection($categories);
        return new JsonResponse($categoryResource, $status, $headers, $isJson);
    }
}
