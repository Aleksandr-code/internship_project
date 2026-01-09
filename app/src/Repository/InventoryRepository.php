<?php

namespace App\Repository;

use App\Entity\Inventory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Inventory>
 */
class InventoryRepository extends ServiceEntityRepository
{
    public function __construct(
        private EntityManagerInterface $em,
        ManagerRegistry $registry)
    {
        parent::__construct($registry, Inventory::class);
    }

    public function save(Inventory $inventory, $isFlush = true):Inventory
    {
        $this->em->persist($inventory);

        if ($isFlush){
            $this->em->flush();
        }
        return $inventory;
    }

    public function destroy(Inventory $inventory, $isFlush = true):void
    {
        $this->em->remove($inventory);

        if ($isFlush){
            $this->em->flush();
        }
    }



}
