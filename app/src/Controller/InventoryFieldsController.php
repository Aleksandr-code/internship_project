<?php

namespace App\Controller;

use App\Entity\Inventory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class InventoryFieldsController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private EntityManagerInterface $em
    )
    {
    }

    #[Route('/api/inventory/{inventory}/fields', name: 'app_inventory_fields_index', methods: ['GET'])]
    public function index(Inventory $inventory): JsonResponse
    {
        $jsonInventoryFields = $this->serializer->serialize($inventory, 'json', ['groups' => ['inventory:fields']]);

        return $this->json([
            'inventoryFields' => $jsonInventoryFields,
        ]);
    }

    #[Route('/api/inventory/{inventory}/fields', name: 'app_inventory_fields_update', methods: ['PATCH'])]
    public function update(Inventory $inventory, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

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

        $this->em->flush();

        return $this->json([
            'message' => 'Updated inventory fields OK',
        ]);
    }
}
