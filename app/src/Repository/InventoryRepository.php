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

    public function findByQuery(int $userID, ?string $title, int $limit, int $offset, string $sortBy = 'createdAt', string $sortDirection = 'ASC'): array
    {
        $sortMap = [
            'createdAt' => 'i.createdAt',
            'title' => 'i.title',
        ];

        $qb = $this->createQueryBuilder('i')
            ->where('i.owner = :user')
            ->setParameter('user', $userID);

        if (isset($title) && strlen(trim($title)) > 0){
            $qb->andWhere('i.title LIKE :title')
                ->setParameter('title', '%' . $title . '%');
        }

        $countQb = clone $qb;
        $countQb->select('COUNT(i.id)');
        $total = $countQb->getQuery()->getSingleScalarResult();

        $inventories = $qb->orderBy($sortMap[$sortBy], $sortDirection)
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();


        return [
            'inventories' => $inventories,
            'total' => $total,
            'pages' => ceil($total / $limit)
        ];
    }

    public function latest(int $limit = 5):array
    {
        return $this->createQueryBuilder('i')
            ->select(
                'i.title AS title',
                'i.description AS description',
                'u.email AS creator')
            ->leftJoin('i.owner', 'u')
            ->orderBy('i.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function topByCountItems(int $limit = 5):array
    {
        return $this->createQueryBuilder('i')
            ->select('i.title AS inventory, COUNT(item.id) AS itemsCount')
            ->leftJoin('i.inventoryItems', 'item')
            ->groupBy('i.id')
            ->orderBy('itemsCount', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }


}
