<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\input\Inventory\StoreInventoryInputDTO;
use App\DTO\input\Inventory\UpdateInventoryInputDTO;
use App\Entity\Inventory;
use App\Factory\InventoryFactory;
use App\Repository\InventoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class InventoryService
{
    public function __construct(
        private InventoryRepository $inventoryRepository,
        private InventoryFactory $inventoryFactory,
        private EntityManagerInterface $em,
        private Security $security
    )
    {
    }

    public function index(array $query):array
    {
        $user = $this->security->getUser();
        $userID = $user->getId();
        $title = $query['title'] ?? null;
        $limit = intval($query['limit'] ?? 5);
        $page = intval($query['page'] ?? 1);
        $sortBy = $query['sortBy'] ?? 'createdAt';
        $sortDirection = $query['sortDirection'] ?? 'ASC';
        $offset = ($page - 1) * $limit;

        return $this->inventoryRepository->findByQuery($userID, $title, $limit, $offset, $sortBy, $sortDirection);
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

    public function latest():array
    {
        return $this->inventoryRepository->latest();
    }

    public function topByCountItems():array
    {
        return $this->inventoryRepository->topByCountItems();
    }
}
