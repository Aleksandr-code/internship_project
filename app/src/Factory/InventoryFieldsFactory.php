<?php

namespace App\Factory;

use App\Entity\Inventory;

class InventoryFieldsFactory
{
    public function updateInventoryFields(Inventory $inventory, array $data):Inventory
    {
        $inventory->setCustomString1Name($data['customString1Name']);
        $inventory->setCustomString1State($data['customString1State']);
        $inventory->setCustomString2Name($data['customString2Name']);
        $inventory->setCustomString2State($data['customString2State']);
        $inventory->setCustomString3Name($data['customString3Name']);
        $inventory->setCustomString3State($data['customString3State']);
        $inventory->setCustomText1Name($data['customText1Name']);
        $inventory->setCustomText1State($data['customText1State']);
        $inventory->setCustomText2Name($data['customText2Name']);
        $inventory->setCustomText2State($data['customText2State']);
        $inventory->setCustomText3Name($data['customText3Name']);
        $inventory->setCustomText3State($data['customText3State']);
        $inventory->setCustomInt1Name($data['customInt1Name']);
        $inventory->setCustomInt1State($data['customInt1State']);
        $inventory->setCustomInt2Name($data['customInt2Name']);
        $inventory->setCustomInt2State($data['customInt2State']);
        $inventory->setCustomInt3Name($data['customInt3Name']);
        $inventory->setCustomInt3State($data['customInt3State']);
        $inventory->setCustomFile1Name($data['customFile1Name']);
        $inventory->setCustomFile1State($data['customFile1State']);
        $inventory->setCustomFile2Name($data['customFile2Name']);
        $inventory->setCustomFile2State($data['customFile2State']);
        $inventory->setCustomFile3Name($data['customFile3Name']);
        $inventory->setCustomFile3State($data['customFile3State']);
        $inventory->setCustomBool1Name($data['customBool1Name']);
        $inventory->setCustomBool1State($data['customBool1State']);
        $inventory->setCustomBool2Name($data['customBool2Name']);
        $inventory->setCustomBool2State($data['customBool2State']);
        $inventory->setCustomBool3Name($data['customBool3Name']);
        $inventory->setCustomBool3State($data['customBool3State']);

        return $inventory;
    }

}
