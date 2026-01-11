<?php

namespace App\Resource;

use Symfony\Component\Serializer\SerializerInterface;

class TagResource
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function tagListCollection(array $tags):string
    {
        return $this->serializer->serialize($tags, 'json', ['groups' => ['tag:list']]);
    }
}
