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
        $tags = $this->tagRepository->findAll();
        return $tags;
    }
}
