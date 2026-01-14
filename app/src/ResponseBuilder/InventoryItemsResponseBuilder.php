<?php

namespace App\ResponseBuilder;

use App\Entity\InventoryItem;
use App\Resource\InventoryItemsResource;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;

class InventoryItemsResponseBuilder
{
    public function __construct(private InventoryItemsResource $inventoryItemsResource)
    {
    }

    public function indexInventoryItemsResponse(array $inventoryItems, $status = 200, $headers = [], $isJson = true):JsonResponse
    {
        $inventoryItemsResource = $this->inventoryItemsResource->inventoryItemsCollection($inventoryItems);
        return new JsonResponse($inventoryItemsResource, $status, $headers, $isJson);
    }

    public function showInventoryItemsResponse(InventoryItem $inventoryItem, $status = 200, $headers = [], $isJson = true):JsonResponse
    {
        $inventoryItemResource = $this->inventoryItemsResource->inventoryItemsOne($inventoryItem);
        return new JsonResponse($inventoryItemResource, $status, $headers, $isJson);
    }

    public function storeInventoryItemsResponse(InventoryItem $inventoryItem, $status = 201, $headers = [], $isJson = true):JsonResponse
    {
        $inventoryItemResource = $this->inventoryItemsResource->inventoryItemsOne($inventoryItem);
        return new JsonResponse($inventoryItemResource, $status, $headers, $isJson);
    }

    public function updateInventoryItemsResponse(InventoryItem $inventoryItem, $status = 200, $headers = [], $isJson = true):JsonResponse
    {
        $inventoryItemResource = $this->inventoryItemsResource->inventoryItemsOne($inventoryItem);
        return new JsonResponse($inventoryItemResource, $status, $headers, $isJson);
    }

    public function destroyInventoryItemResponse($status = 200, $headers = []):JsonResponse
    {
        return new JsonResponse(['message' => 'Inventory items deleted'], $status, $headers);
    }


}
