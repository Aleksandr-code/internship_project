<?php

namespace App\Resource;

use Symfony\Component\Serializer\SerializerInterface;

class CategoryResource
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function categoryListCollection(array $categories):string
    {
        return $this->serializer->serialize($categories, 'json', ['groups' => ['category:list']]);
    }
}
