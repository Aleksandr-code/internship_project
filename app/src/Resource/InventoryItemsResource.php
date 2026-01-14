<?php

namespace App\Resource;

use App\Entity\InventoryItem;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\SerializerInterface;

class InventoryItemsResource
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function inventoryItemsOne(InventoryItem $inventoryItem):string
    {
        return $this->serializer->serialize($inventoryItem, 'json', ['groups' => ['inventory:items']]);
    }

    public function inventoryItemsCollection(array $inventoryItems):string
    {
        return $this->serializer->serialize($inventoryItems, 'json', ['groups' => ['inventory:items']]);
    }
}
