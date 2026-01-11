<?php

namespace App\Controller;

use App\Entity\Inventory;
use App\ResponseBuilder\InventoryFieldsResponseBuilder;
use App\Service\InventoryFieldsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class InventoryFieldsController extends AbstractController
{
    public function __construct(
        private InventoryFieldsResponseBuilder $inventoryFieldsResponseBuilder,
        private InventoryFieldsService $inventoryFieldsService,
    )
    {
    }

    #[Route('/api/inventory/{inventory}/fields', name: 'app_inventory_fields_index', methods: ['GET'])]
    public function index(Inventory $inventory): JsonResponse
    {
        return $this->inventoryFieldsResponseBuilder->indexInventoryFieldsResponse($inventory);
    }

    #[Route('/api/inventory/{inventory}/fields', name: 'app_inventory_fields_update', methods: ['PATCH'])]
    public function update(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->inventoryFieldsService->update($inventory, $data);

        return $this->inventoryFieldsResponseBuilder->updateInventoryFieldsResponse('Updated inventory fields OK');
    }
}
