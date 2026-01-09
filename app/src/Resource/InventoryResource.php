<?php

namespace App\Resource;

use App\Entity\Inventory;
use Symfony\Component\Serializer\SerializerInterface;

class InventoryResource
{
    public function __construct(
        private SerializerInterface $serializer
    )
    {
    }

    public function inventoryMain(Inventory $inventory): string
    {
        return $this->serializer->serialize($inventory, 'json', ['groups' => ['inventory:main']]);
    }

    public function inventoryMainCollection(array $inventories): string
    {
        return $this->serializer->serialize($inventories, 'json', ['groups' => ['inventory:main']]);
    }
}
