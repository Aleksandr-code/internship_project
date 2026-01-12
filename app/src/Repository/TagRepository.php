<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tag>
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

        /**
         * @return Tag[] Returns an array of Tag objects
         */
        public function findByQuery(?string $title, int $limit): array
        {
            $qb = $this->createQueryBuilder('t');

            if (isset($title)){
                $qb->andWhere('t.title LIKE :title')
                    ->setParameter('title', '%' . $title . '%');
            }

            $query = $qb->setMaxResults($limit)->getQuery();

            return $query->getResult();
        }

}
