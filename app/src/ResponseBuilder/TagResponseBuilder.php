<?php

namespace App\ResponseBuilder;

use App\Resource\TagResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class TagResponseBuilder
{
    public function __construct(private TagResource $tagResource)
    {
    }

    public function indexTagResponse(array $tags, $status = 200, $headers = [], $isJson = true):JsonResponse
    {
        $tagResource = $this->tagResource->tagListCollection($tags);
        return new JsonResponse($tagResource, $status, $headers, $isJson);
    }

}
