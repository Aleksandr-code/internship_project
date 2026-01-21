<?php

namespace App\Controller;

use App\Entity\Inventory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class InventoryAccessController extends AbstractController
{

    public function __construct(private SerializerInterface $serializer)
    {
    }

    #[Route('/api/inventory/{inventory}/access', name: 'app_inventory_access_index', methods: ['GET'])]
    public function index(Inventory $inventory): JsonResponse
    {
        $serializeEditors = $this->serializer->serialize($inventory, 'json', ['groups' => ['inventory:access']]);

        return new JsonResponse($serializeEditors, 200, [], false);
    }

    #[Route('/api/inventory/{inventory}/access', name: 'app_inventory_access_update', methods: ['PATCH'])]
    public function update(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        // edit
        return new JsonResponse(['message' => 'updated'], 200, [], false);
    }

    #[Route('/api/inventory/{inventory}/access/destroy', name: 'app_inventory_access_destroy', methods: ['POST'])]
    public function destroy(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        // edit
        return new JsonResponse(['message' => 'deleted'], 200, [], false);
    }
}
