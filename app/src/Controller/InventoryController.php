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
    public function index(): JsonResponse
    {
        $inventories = $this->inventoryService->index();

        return $this->inventoryResponseBuilder->indexInventoryResponse($inventories);
    }

    #[Route('/api/inventory/{inventory}', name: 'app_inventory_show', methods: ['GET'])]
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
}
