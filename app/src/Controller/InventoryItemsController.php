<?php

namespace App\Controller;

use App\DTOValidator\DTOValidator;
use App\Entity\Inventory;
use App\Entity\InventoryItem;
use App\Factory\InventoryItemsFactory;
use App\ResponseBuilder\InventoryItemsResponseBuilder;
use App\Service\InventoryItemsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class InventoryItemsController extends AbstractController
{
    public function __construct(
        private InventoryItemsService $inventoryItemsService,
        private InventoryItemsResponseBuilder $inventoryItemsResponseBuilder,
        private InventoryItemsFactory $inventoryItemsFactory,
        private DTOValidator $inventoryItemsDTOValidator
    )
    {
    }

    #[Route('/api/inventory/{inventory}/items', name: 'app_inventory_items_index', methods: ['GET'])]
    public function index(Inventory $inventory): JsonResponse
    {
        $inventoryItems = $this->inventoryItemsService->index($inventory);

        return $this->inventoryItemsResponseBuilder->indexInventoryItemsResponse($inventoryItems);
    }

    #[Route('/api/inventory/{inventory}/items/{inventoryItem}', name: 'app_inventory_items_show', methods: ['GET'])]
    public function show(Inventory $inventory, InventoryItem $inventoryItem): JsonResponse
    {
        return $this->inventoryItemsResponseBuilder->showInventoryItemsResponse($inventoryItem);
    }

    #[Route('/api/inventory/{inventory}/items', name: 'app_inventory_items_store', methods: ['POST'])]
    public function store(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $storeInventoryItemInputDTO = $this->inventoryItemsFactory->makeStoreInventoryItemDTO($data);
        $res = $this->inventoryItemsDTOValidator->validate($storeInventoryItemInputDTO);
        if ($res){
            return $res;
        }

        $inventoryItem = $this->inventoryItemsService->store($inventory, $storeInventoryItemInputDTO);

        return $this->inventoryItemsResponseBuilder->storeInventoryItemsResponse($inventoryItem);
    }

    #[Route('/api/inventory/{inventory}/items/{inventoryItem}', name: 'app_inventory_items_update', methods: ['PATCH'])]
    public function update(Inventory $inventory, InventoryItem $inventoryItem, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $updateInventoryItemInputDTO = $this->inventoryItemsFactory->makeUpdateInventoryItemDTO($data);
        $res = $this->inventoryItemsDTOValidator->validate($updateInventoryItemInputDTO);
        if ($res){
            return $res;
        }

        $inventoryItem = $this->inventoryItemsService->update($inventoryItem, $updateInventoryItemInputDTO);

        return $this->inventoryItemsResponseBuilder->updateInventoryItemsResponse($inventoryItem);
    }

    #[Route('/api/inventory/{inventory}/items/destroy', name: 'app_inventory_items_destroy', methods: ['POST'])]
    public function destroy(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->inventoryItemsService->destroy($data);

        return $this->inventoryItemsResponseBuilder->destroyInventoryItemResponse();
    }


}
