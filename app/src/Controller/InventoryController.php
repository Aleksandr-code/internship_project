<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Inventory;
use App\Entity\Tag;
use App\Repository\InventoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class InventoryController extends AbstractController
{
    public function __construct(
        private InventoryRepository $inventoryRepository,
        private SerializerInterface $serializer,
        private EntityManagerInterface $em)
    {
    }

    #[Route('/api/inventory', name: 'app_inventory_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $inventories = $this->inventoryRepository->findAll();
        $jsonInventory = $this->serializer->serialize($inventories, 'json', ['groups' => ['inventory:main']]);

        return $this->json([
            'inventories' => $jsonInventory,
        ]);
    }

    #[Route('/api/inventory/{inventory}', name: 'app_inventory_show', methods: ['GET'])]
    public function show(Inventory $inventory): JsonResponse
    {
        $jsonInventory = $this->serializer->serialize($inventory, 'json', ['groups' => ['inventory:main']]);

        return $this->json([
            'inventory' => $jsonInventory,
        ]);
    }

    #[Route('/api/inventory', name: 'app_inventory_store', methods: ['POST'])]
    public function store(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $category = $this->em->getReference(Category::class, $data['category_id']);

        $inventory = new Inventory();
        $inventory->setTitle($data['title']);
        $inventory->setDescription($data['description']);
        $inventory->setImageUrl($data['image_url']);
        $inventory->setCategory($category);
        foreach ($data['tags_id'] as $tagId) {
            $tag = $this->em->getReference(Tag::class, $tagId);
            $inventory->addTag($tag);
        }
        $inventory->setCreatedAt(new \DateTimeImmutable($data['created_at']));
        $inventory->setIsPublic($data['is_public']);

        $this->em->persist($inventory);
        $this->em->flush();

        $jsonInventory = $this->serializer->serialize($inventory, 'json', ['groups' => ['inventory:main']]);

        return $this->json([
            'inventory' => $jsonInventory,
        ]);
    }

    #[Route('/api/inventory/{inventory}', name: 'app_inventory_update', methods: ['PATCH'])]
    public function update(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $category = $this->em->getReference(Category::class, $data['category_id']);

        $inventory->setTitle($data['title']);
        $inventory->setDescription($data['description']);
        $inventory->setImageUrl($data['image_url']);
        $inventory->setCategory($category);
        foreach ($data['tags_id'] as $tagId) {
            $tag = $this->em->getReference(Tag::class, $tagId);
            $inventory->addTag($tag);
        }
        $inventory->setCreatedAt(new \DateTimeImmutable($data['created_at']));
        $inventory->setIsPublic($data['is_public']);

        $this->em->persist($inventory);
        $this->em->flush();

        $jsonInventory = $this->serializer->serialize($inventory, 'json', ['groups' => ['inventory:main']]);

        return $this->json([
            'inventory' => $jsonInventory,
        ]);
    }

    #[Route('/api/inventory', name: 'app_inventory_destroy', methods: ['DELETE'])]
    public function destroy(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        foreach ($data['ids'] as $inventoryId) {
            $inventory = $this->em->getReference(Inventory::class, $inventoryId);
            $this->em->remove($inventory);
        }
        $this->em->flush();

        return $this->json([
            'message' => 'Inventory deleted',
        ]);
    }
}
