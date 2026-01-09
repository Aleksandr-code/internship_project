<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Inventory;
use App\Entity\Tag;
use App\Factory\InventoryFactory;
use App\Repository\InventoryRepository;
use App\Resouce\InventoryResource;
use App\ResponseBuilder\InventoryResponseBuilder;
use App\Service\InventoryService;
use App\DTOValidator\InventoryDTOValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class InventoryController extends AbstractController
{
    public function __construct(
        private InventoryRepository      $inventoryRepository,
        private SerializerInterface      $serializer,
        private EntityManagerInterface   $em,
        private InventoryService         $inventoryService,
        private InventoryDTOValidator    $inventoryDTOValidator,
        private InventoryResponseBuilder $inventoryResponseBuilder,
        private InventoryFactory         $inventoryFactory,
    )
    {
    }

    #[Route('/api/inventory', name: 'app_inventory_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $inventories = $this->inventoryService->index();
        $this->inventoryResponseBuilder->indexInventoryResponse($inventories);

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

        $jsonResponse = $this->inventoryResponseBuilder->storeInventoryResponse($inventory);

        return $jsonResponse;
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

        $jsonResponse = $this->inventoryResponseBuilder->updateInventoryResponse($inventory);

        return $jsonResponse;
    }

    #[Route('/api/inventory', name: 'app_inventory_destroy', methods: ['DELETE'])]
    public function destroy(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->inventoryService->destroy($data);

        $jsonResponse = $this->inventoryResponseBuilder->destroyInventoryResponse();

        return $jsonResponse;
    }
}
