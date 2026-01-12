<?php

namespace App\Service;

use App\Repository\TagRepository;

class TagService
{
    public function __construct(private TagRepository $tagRepository)
    {
    }

    public function index(array $query):array
    {
        $title = $query['title'] ?? null;
        $limit = $query['limit'] ?? 10;

        $tags = $this->tagRepository->findByQuery($title, $limit);
        return $tags;
    }
}
