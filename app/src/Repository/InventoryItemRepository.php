<?php

namespace App\Repository;

use App\Entity\InventoryItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InventoryItem>
 */
class InventoryItemRepository extends ServiceEntityRepository
{
    public function __construct(private EntityManagerInterface $em, ManagerRegistry $registry)
    {
        parent::__construct($registry, InventoryItem::class);
    }

    public function save(InventoryItem $inventoryItem, $isFlush = true):InventoryItem
    {
        $this->em->persist($inventoryItem);

        if ($isFlush){
            $this->em->flush();
        }
        return $inventoryItem;
    }

    public function destroy(InventoryItem $inventoryItem, $isFlush = true):void
    {
        $this->em->remove($inventoryItem);

        if ($isFlush){
            $this->em->flush();
        }
    }
}
