<?php

namespace App\Service;

use App\Entity\Inventory;
use App\Factory\InventoryFieldsFactory;
use Doctrine\ORM\EntityManagerInterface;

class InventoryFieldsService
{
    public function __construct(
        private EntityManagerInterface $em,
        private InventoryFieldsFactory $inventoryFieldsFactory,
    )
    {
    }

    public function update(Inventory $inventory, array $data):Inventory
    {
        $inventory = $this->inventoryFieldsFactory->updateInventoryFields($inventory, $data);
        $this->em->flush();

        return $inventory;
    }
}
