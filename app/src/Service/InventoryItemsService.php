<?php

namespace App\Service;

use App\DTO\input\InventoryItem\StoreInventoryItemInputDTO;
use App\DTO\input\InventoryItem\UpdateInventoryItemInputDTO;
use App\Entity\Inventory;
use App\Entity\InventoryItem;
use App\Factory\InventoryItemsFactory;
use App\Repository\InventoryItemRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class InventoryItemsService
{
    public function __construct(
        private InventoryItemRepository $inventoryItemRepository,
        private InventoryItemsFactory $inventoryItemsFactory,
        private EntityManagerInterface $em,
    )
    {
    }

    public function index(Inventory $inventory, array $query): array
    {
        $inventoryId = $inventory->getId();
        $search = $query['search'] ?? null;
        $limit = intval($query['limit'] ?? 5);
        $page = intval($query['page'] ?? 1);
        $offset = ($page - 1) * $limit;

        return $this->inventoryItemRepository->findByQuery($inventoryId, $search, $limit, $offset);
    }

    public function store(Inventory $inventory, StoreInventoryItemInputDTO $storeInventoryItemInputDTO):InventoryItem
    {
        $inventoryItem = $this->inventoryItemsFactory->makeInventoryItem($inventory, $storeInventoryItemInputDTO);
        return $this->inventoryItemRepository->save($inventoryItem);
    }

    public function update(InventoryItem $inventoryItem, UpdateInventoryItemInputDTO $updateInventoryItemInputDTO):InventoryItem
    {
        $inventoryItem = $this->inventoryItemsFactory->editInventoryItem($inventoryItem, $updateInventoryItemInputDTO);
        return $this->inventoryItemRepository->save($inventoryItem);
    }

    public function destroy(array $data):void
    {
        $lastIndex = count($data['ids']) - 1;
        foreach ($data['ids'] as $key => $inventoryItemId) {
            $inventory = $this->em->getReference(InventoryItem::class, $inventoryItemId);
            $this->inventoryItemRepository->destroy($inventory, false);
            if($lastIndex === $key){
                $this->inventoryItemRepository->destroy($inventory, true);
            }
        }
    }
}
