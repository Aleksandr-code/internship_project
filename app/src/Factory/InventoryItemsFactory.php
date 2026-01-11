<?php

namespace App\Factory;

use App\DTO\input\InputDTO;
use App\DTO\input\InventoryItem\StoreInventoryItemInputDTO;
use App\DTO\input\InventoryItem\UpdateInventoryItemInputDTO;
use App\Entity\Inventory;
use App\Entity\InventoryItem;

class InventoryItemsFactory
{
    public function makeInventoryItem(Inventory $inventory, StoreInventoryItemInputDTO $storeInventoryItemInputDTO):InventoryItem
    {
        $inventoryItem = new InventoryItem();
        $inventoryItem = $this->setInventoryItemValues($inventoryItem, $storeInventoryItemInputDTO);
        $inventoryItem->setInventory($inventory);
        $inventoryItem->setCreatedAt(new \DateTimeImmutable());

        return $inventoryItem;
    }

    public function editInventoryItem(InventoryItem $inventoryItem, UpdateInventoryItemInputDTO $updateInventoryItemInputDTO):InventoryItem
    {
        $inventoryItem = $this->setInventoryItemValues($inventoryItem, $updateInventoryItemInputDTO);
        return $inventoryItem;
    }

    public function setInventoryItemValues(InventoryItem $inventoryItem, InputDTO $inventoryItemInputDTO):InventoryItem
    {
        $inventoryItem->setString1Value($inventoryItemInputDTO->string1Value);
        $inventoryItem->setString2Value($inventoryItemInputDTO->string2Value);
        $inventoryItem->setString3Value($inventoryItemInputDTO->string3Value);
        $inventoryItem->setText1Value($inventoryItemInputDTO->text1Value);
        $inventoryItem->setText2Value($inventoryItemInputDTO->text2Value);
        $inventoryItem->setText3Value($inventoryItemInputDTO->text3Value);
        $inventoryItem->setInt1Value($inventoryItemInputDTO->int1Value);
        $inventoryItem->setInt2Value($inventoryItemInputDTO->int2Value);
        $inventoryItem->setInt3Value($inventoryItemInputDTO->int3Value);
        $inventoryItem->setFile1Value($inventoryItemInputDTO->file1Value);
        $inventoryItem->setFile2Value($inventoryItemInputDTO->file2Value);
        $inventoryItem->setFile3Value($inventoryItemInputDTO->file3Value);
        $inventoryItem->setBool1Value($inventoryItemInputDTO->bool1Value);
        $inventoryItem->setBool2Value($inventoryItemInputDTO->bool2Value);
        $inventoryItem->setBool3Value($inventoryItemInputDTO->bool3Value);

        return $inventoryItem;
    }

    public function makeStoreInventoryItemDTO(array $data):StoreInventoryItemInputDTO
    {
        $inventoryItem = new StoreInventoryItemInputDTO();
        $inventoryItem = $this->setInventoryItemValuesDTO($inventoryItem, $data);
        return $inventoryItem;
    }

    public function makeUpdateInventoryItemDTO(array $data):UpdateInventoryItemInputDTO
    {
        $inventoryItem = new UpdateInventoryItemInputDTO();
        $inventoryItem = $this->setInventoryItemValuesDTO($inventoryItem, $data);
        return $inventoryItem;
    }

    public function setInventoryItemValuesDTO(StoreInventoryItemInputDTO|UpdateInventoryItemInputDTO $inventoryItem, array $data):StoreInventoryItemInputDTO|UpdateInventoryItemInputDTO
    {
        $inventoryItem->string1Value = $data['string1Value'] ?? null;
        $inventoryItem->string2Value = $data['string2Value'] ?? null;
        $inventoryItem->string3Value = $data['string3Value'] ?? null;
        $inventoryItem->text1Value = $data['text1Value'] ?? null;
        $inventoryItem->text2Value = $data['text2Value'] ?? null;
        $inventoryItem->text3Value = $data['text3Value'] ?? null;
        $inventoryItem->int1Value = $data['int1Value'] ?? null;
        $inventoryItem->int2Value = $data['int2Value'] ?? null;
        $inventoryItem->int3Value = $data['int3Value'] ?? null;
        $inventoryItem->file1Value = $data['file1Value'] ?? null;
        $inventoryItem->file2Value = $data['file2Value'] ?? null;
        $inventoryItem->file3Value = $data['file3Value'] ?? null;
        $inventoryItem->bool1Value = $data['bool1Value'] ?? null;
        $inventoryItem->bool2Value = $data['bool2Value'] ?? null;
        $inventoryItem->bool3Value = $data['bool3Value'] ?? null;

        return $inventoryItem;
    }


}
