<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class TagController extends AbstractController
{
    #[Route('/api/tags', name: 'app_tag_index', methods: ['GET'])]
    public function index(TagRepository $tagRepository, SerializerInterface $serializer): JsonResponse
    {
        $tags = $tagRepository->findAll();
        $jsonTags = $serializer->serialize($tags, 'json', ['groups' => ['tag:list']]);

        return $this->json([
            'tags' => $jsonTags,
        ]);
    }
}
