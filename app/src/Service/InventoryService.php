<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\input\Inventory\StoreInventoryInputDTO;
use App\DTO\input\Inventory\UpdateInventoryInputDTO;
use App\Entity\Inventory;
use App\Factory\InventoryFactory;
use App\Repository\InventoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class InventoryService
{
    public function __construct(
        private InventoryRepository $inventoryRepository,
        private InventoryFactory $inventoryFactory,
        private EntityManagerInterface $em
    )
    {
    }

    public function index():array
    {
        return $this->inventoryRepository->findAll();
    }

    public function store(StoreInventoryInputDTO $storeInventoryInputDTO): Inventory
    {
        $inventory = $this->inventoryFactory->makeInventory($storeInventoryInputDTO);
        return $this->inventoryRepository->save($inventory);
    }

    public function update(Inventory $inventory, UpdateInventoryInputDTO $updateInventoryInputDTO): Inventory
    {
        $inventory = $this->inventoryFactory->editInventory($inventory, $updateInventoryInputDTO);
        return $this->inventoryRepository->save($inventory);
    }

    public function destroy(array $data):void{
        $lastIndex = count($data['ids']) - 1;
        foreach ($data['ids'] as $key => $inventoryId) {
            $inventory = $this->em->getReference(Inventory::class, $inventoryId);
            $this->inventoryRepository->destroy($inventory, false);
            if($lastIndex === $key){
                $this->inventoryRepository->destroy($inventory, true);
            }
        }
    }

}
