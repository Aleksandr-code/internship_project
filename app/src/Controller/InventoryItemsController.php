<?php

namespace App\Controller;

use App\Entity\Inventory;
use App\Entity\InventoryItem;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class InventoryItemsController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private EntityManagerInterface $em)
    {
    }

    #[Route('/api/inventory/{inventory}/items', name: 'app_inventory_items_index', methods: ['GET'])]
    public function index(Inventory $inventory): JsonResponse
    {
        $inventoryItems = $inventory->getInventoryItems();

        $jsonInventoryItems = $this->serializer->serialize($inventoryItems, 'json', ['groups' => ['inventory:items']]);

        return $this->json([
            'inventoryItems' => $jsonInventoryItems,
        ]);
    }

    #[Route('/api/inventory/{inventory}/items/{inventoryItem}', name: 'app_inventory_items_show', methods: ['GET'])]
    public function show(Inventory $inventory, InventoryItem $inventoryItem): JsonResponse
    {
        $jsonInventoryItem = $this->serializer->serialize($inventoryItem, 'json', ['groups' => ['inventory:items']]);

        return $this->json([
            'inventoryItems' => $jsonInventoryItem,
        ]);
    }

    #[Route('/api/inventory/{inventory}/items', name: 'app_inventory_items_store', methods: ['POST'])]
    public function store(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $inventoryItem = new InventoryItem();
        $inventoryItem->setInventory($inventory);
        $inventoryItem->setString1Value($data['string1Value'] ?? null);
        $inventoryItem->setString2Value($data['string2Value'] ?? null);
        $inventoryItem->setString3Value($data['string3Value'] ?? null);
        $inventoryItem->setText1Value($data['text1Value'] ?? null);
        $inventoryItem->setText2Value($data['text2Value'] ?? null);
        $inventoryItem->setText3Value($data['text3Value'] ?? null);
        $inventoryItem->setInt1Value($data['int1Value'] ?? null);
        $inventoryItem->setInt2Value($data['int2Value'] ?? null);
        $inventoryItem->setInt3Value($data['int3Value'] ?? null);
        $inventoryItem->setFile1Value($data['file1Value'] ?? null);
        $inventoryItem->setFile2Value($data['file2Value'] ?? null);
        $inventoryItem->setFile3Value($data['file3Value'] ?? null);
        $inventoryItem->setBool1Value($data['bool1Value'] ?? null);
        $inventoryItem->setBool2Value($data['bool2Value'] ?? null);
        $inventoryItem->setBool3Value($data['bool3Value'] ?? null);
        $inventoryItem->setCreatedAt(new \DateTimeImmutable($data['created_at']));

        $this->em->persist($inventoryItem);
        $this->em->flush();

        $jsonInventoryItem = $this->serializer->serialize($inventoryItem, 'json', ['groups' => ['inventory:items']]);

        return $this->json([
            'inventoryItem' => $jsonInventoryItem,
        ]);
    }

    #[Route('/api/inventory/{inventory}/items/{inventoryItem}', name: 'app_inventory_items_update', methods: ['PATCH'])]
    public function update(Inventory $inventory, InventoryItem $inventoryItem, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $inventoryItem->setString1Value($data['string1Value'] ?? null);
        $inventoryItem->setString2Value($data['string2Value'] ?? null);
        $inventoryItem->setString3Value($data['string3Value'] ?? null);
        $inventoryItem->setText1Value($data['text1Value'] ?? null);
        $inventoryItem->setText2Value($data['text2Value'] ?? null);
        $inventoryItem->setText3Value($data['text3Value'] ?? null);
        $inventoryItem->setInt1Value($data['int1Value'] ?? null);
        $inventoryItem->setInt2Value($data['int2Value'] ?? null);
        $inventoryItem->setInt3Value($data['int3Value'] ?? null);
        $inventoryItem->setFile1Value($data['file1Value'] ?? null);
        $inventoryItem->setFile2Value($data['file2Value'] ?? null);
        $inventoryItem->setFile3Value($data['file3Value'] ?? null);
        $inventoryItem->setBool1Value($data['bool1Value'] ?? null);
        $inventoryItem->setBool2Value($data['bool2Value'] ?? null);
        $inventoryItem->setBool3Value($data['bool3Value'] ?? null);

        $this->em->flush();

        $jsonInventoryItem = $this->serializer->serialize($inventoryItem, 'json', ['groups' => ['inventory:items']]);

        return $this->json([
            'inventoryItem' => $jsonInventoryItem,
        ]);
    }

    #[Route('/api/inventory/{inventory}/items/destroy', name: 'app_inventory_items_destroy', methods: ['POST'])]
    public function destroy(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        foreach ($data['ids'] as $inventoryItemID) {
            $inventoryItem = $this->em->getReference(InventoryItem::class, $inventoryItemID);
            $this->em->remove($inventoryItem);
        }
        $this->em->flush();

        return $this->json([
            'message' => 'InventoryItems deleted',
        ]);
    }


}
