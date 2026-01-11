<?php

namespace App\ResponseBuilder;

use App\Entity\Inventory;
use App\Resource\InventoryFieldsResource;
use Symfony\Component\HttpFoundation\JsonResponse;

class InventoryFieldsResponseBuilder
{
    public function __construct(private InventoryFieldsResource $inventoryFieldsResource)
    {
    }

    public function indexInventoryFieldsResponse(Inventory $inventory, $status = 200, $headers = [], $isJson = true): JsonResponse
    {
        $inventoryFieldsResource = $this->inventoryFieldsResource->indexInventoryFields($inventory);
        return new JsonResponse($inventoryFieldsResource, $status, $headers, $isJson);
    }

    public function updateInventoryFieldsResponse(string $message, $status = 200, $headers = []): JsonResponse
    {
        return new JsonResponse(['message' => $message], $status, $headers);
    }
}
