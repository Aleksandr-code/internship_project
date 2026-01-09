<?php

namespace App\ResponseBuilder;

use App\Entity\Inventory;
use App\Resource\InventoryResource;
use App\Service\InventoryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Json;

class InventoryResponseBuilder
{
    public function __construct(
        private InventoryResource $inventoryResource
    )
    {
    }

    public function indexInventoryResponse(array $inventories, $status = 200, $headers = [], $isJson = true):JsonResponse
    {
        $inventoryResource = $this->inventoryResource->inventoryMainCollection($inventories);
        return new JsonResponse($inventoryResource, $status, $headers, $isJson);
    }

    public function showInventoryResponse(Inventory $inventory, $status = 200, $headers = [], $isJson = true):JsonResponse
    {
        $inventoryResource = $this->inventoryResource->inventoryMain($inventory);
        return new JsonResponse($inventoryResource, $status, $headers, $isJson);
    }

    public function storeInventoryResponse(Inventory $inventory, $status = 201, $headers = [], $isJson = true):JsonResponse
    {
        $inventoryResource = $this->inventoryResource->inventoryMain($inventory);
        return new JsonResponse($inventoryResource, $status, $headers, $isJson);
    }

    public function updateInventoryResponse(Inventory $inventory, $status = 200, $headers = [], $isJson = true):JsonResponse
    {
        $inventoryResource = $this->inventoryResource->inventoryMain($inventory);
        return new JsonResponse($inventoryResource, $status, $headers, $isJson);
    }

    public function destroyInventoryResponse($status = 200, $headers = []):JsonResponse
    {
        return new JsonResponse(['message' => 'deleted'], $status, $headers);
    }
}
