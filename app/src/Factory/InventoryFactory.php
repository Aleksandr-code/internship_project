<?php

namespace App\Factory;

use App\DTO\input\Inventory\StoreInventoryInputDTO;
use App\DTO\input\Inventory\UpdateInventoryInputDTO;
use App\Entity\Category;
use App\Entity\Inventory;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class InventoryFactory
{
    public function __construct(
        private EntityManagerInterface $em,
        private Security $security,
    )
    {
    }

    public function makeInventory(StoreInventoryInputDTO $storeInventoryInputDTO):Inventory
    {
        $category = $this->em->getReference(Category::class, $storeInventoryInputDTO->categoryId);

        $inventory = new Inventory();
        $inventory->setOwner($this->security->getUser());
        $inventory->setTitle($storeInventoryInputDTO->title);
        $inventory->setDescription($storeInventoryInputDTO->description);
        $inventory->setImageUrl($storeInventoryInputDTO->imageUrl);
        $inventory->setCategory($category);
        foreach ($storeInventoryInputDTO->tags as $tagId) {
            $tag = $this->em->getReference(Tag::class, $tagId);
            $inventory->addTag($tag);
        }
        $inventory->setIsPublic(1);
        $inventory->setCreatedAt($storeInventoryInputDTO->createdAt);

        return $inventory;
    }

    public function editInventory(Inventory $inventory, UpdateInventoryInputDTO $updateInventoryInputDTO):Inventory
    {
        $category = $this->em->getReference(Category::class, $updateInventoryInputDTO->categoryId);

        $inventory->setOwner($this->security->getUser());
        $inventory->setTitle($updateInventoryInputDTO->title);
        $inventory->setDescription($updateInventoryInputDTO->description);
        $inventory->setImageUrl($updateInventoryInputDTO->imageUrl);
        $inventory->setCategory($category);
        foreach ($updateInventoryInputDTO->tags as $tagId) {
            $tag = $this->em->getReference(Tag::class, $tagId);
            $inventory->addTag($tag);
        }
        $inventory->setIsPublic(1);

        return $inventory;
    }

    public function makeStoreInventoryDTO(array $data): StoreInventoryInputDTO
    {
        $inventory = new StoreInventoryInputDTO();
        $inventory->title = $data['title'] ?? null;
        $inventory->description = $data['description'] ?? null;
        $inventory->imageUrl = $data['image_url'] ?? null;
        $inventory->categoryId = $data['category_id'] ?? null;
        $inventory->tags = $data['tags_id'] ?? null;
        $inventory->createdAt = new \DateTimeImmutable();

        return $inventory;
    }

    public function makeUpdateInventoryDTO(array $data): UpdateInventoryInputDTO
    {
        $inventory = new UpdateInventoryInputDTO();
        $inventory->title = $data['title'] ?? null;
        $inventory->description = $data['description'] ?? null;
        $inventory->imageUrl = $data['image_url'] ?? null;
        $inventory->categoryId = $data['category_id'] ?? null;
        $inventory->tags = $data['tags_id'] ?? null;
        //$inventory->createdAt = new \DateTimeImmutable();

        return $inventory;
    }
}
