<?php

namespace App\Controller;

use App\Entity\Inventory;
use App\Factory\InventoryFactory;
use App\ResponseBuilder\InventoryResponseBuilder;
use App\Service\InventoryService;
use App\DTOValidator\DTOValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class InventoryController extends AbstractController
{
    public function __construct(
        private InventoryService         $inventoryService,
        private DTOValidator             $inventoryDTOValidator,
        private InventoryResponseBuilder $inventoryResponseBuilder,
        private InventoryFactory         $inventoryFactory,
    )
    {
    }

    #[Route('/api/inventory', name: 'app_inventory_index', methods: ['GET'])]
    public function index(Request $request): JsonResponse
    {
        $query = $request->query->all();

        $inventories = $this->inventoryService->index($query);

        return $this->inventoryResponseBuilder->indexInventoryResponse($inventories);
    }

    #[Route('/api/inventory/{inventory}', name: 'app_inventory_show', requirements: ['inventory' => '\d+'], methods: ['GET'])]
    public function show(Inventory $inventory): JsonResponse
    {
        return $this->inventoryResponseBuilder->showInventoryResponse($inventory);
    }

    #[Route('/api/inventory', name: 'app_inventory_store', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $storeInventoryInputDTO = $this->inventoryFactory->makeStoreInventoryDTO($data);
        $res = $this->inventoryDTOValidator->validate($storeInventoryInputDTO);
        if ($res){
            return $res;
        }

        $inventory = $this->inventoryService->store($storeInventoryInputDTO);

        return $this->inventoryResponseBuilder->storeInventoryResponse($inventory);
    }

    #[Route('/api/inventory/{inventory}', name: 'app_inventory_update', methods: ['PATCH'])]
    public function update(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $updateInventoryInputDTO = $this->inventoryFactory->makeUpdateInventoryDTO($data);
        $res = $this->inventoryDTOValidator->validate($updateInventoryInputDTO);
        if ($res){
            return $res;
        }

        $inventory = $this->inventoryService->update($inventory, $updateInventoryInputDTO);

        return $this->inventoryResponseBuilder->updateInventoryResponse($inventory);
    }

    #[Route('/api/inventory/destroy', name: 'app_inventory_destroy', methods: ['POST'])]
    public function destroy(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->inventoryService->destroy($data);

        return $this->inventoryResponseBuilder->destroyInventoryResponse();
    }

    #[Route('/api/inventory/latest', name: 'app_inventory_latest', methods: ['GET'])]
    public function latest(): JsonResponse
    {
        $inventories = $this->inventoryService->latest();

        return new JsonResponse($inventories, 200, [], false);
    }

    #[Route('/api/inventory/top', name: 'app_inventory_top', methods: ['GET'])]
    public function topByCountItems(): JsonResponse
    {
        $inventories = $this->inventoryService->topByCountItems();

        return new JsonResponse($inventories, 200, [], false);
    }
}
