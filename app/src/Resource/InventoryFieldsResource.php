<?php

namespace App\Resource;

use App\Entity\Inventory;
use Symfony\Component\Serializer\SerializerInterface;

class InventoryFieldsResource
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function indexInventoryFields(Inventory $inventory):string
    {
        return $this->serializer->serialize($inventory, 'json', ['groups' => ['inventory:fields']]);
    }
}
