<?php

namespace App\Controller;

use App\ResponseBuilder\TagResponseBuilder;
use App\Service\TagService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class TagController extends AbstractController
{
    public function __construct(
        private TagService  $tagService,
        private TagResponseBuilder $tagResponseBuilder
    )
    {
    }

    #[Route('/api/tags', name: 'app_tag_index', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        $query = $request->query->all();

        $tags = $this->tagService->index($query);

        return $this->tagResponseBuilder->indexTagResponse($tags);
    }
}
