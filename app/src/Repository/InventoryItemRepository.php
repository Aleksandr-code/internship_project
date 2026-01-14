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

    public function findByQuery(int $inventoryId, ?string $search, int $limit, int $offset): array
    {

        $qb = $this->createQueryBuilder('i')
            ->where('i.inventory = :inventory')
            ->setParameter('inventory', $inventoryId);

        if (isset($search) && strlen(trim($search)) > 0){
            $qb->andWhere('i.string1Value LIKE :search OR i.string2Value LIKE :search OR i.string3Value LIKE :search
                OR i.text1Value LIKE :search OR i.text2Value LIKE :search OR i.text3Value LIKE :search')
                ->setParameter('search', '%' . $search . '%');
        }

        $countQb = clone $qb;
        $countQb->select('COUNT(i.id)');
        $total = $countQb->getQuery()->getSingleScalarResult();

        $inventoryItems = $qb->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();


        return [
            'inventoryItems' => $inventoryItems,
            'total' => $total,
            'pages' => ceil($total / $limit)
        ];
    }
}
