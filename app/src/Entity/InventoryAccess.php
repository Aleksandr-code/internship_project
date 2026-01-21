<?php

namespace App\Entity;

use App\Repository\InventoryAccessRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: InventoryAccessRepository::class)]
class InventoryAccess
{
    #[Groups(groups: ['inventory:access'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'inventoryAccesses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Inventory $inventory = null;
    #[Groups(groups: ['inventory:access'])]
    #[ORM\ManyToOne(inversedBy: 'inventoryAccesses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $editor = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(?Inventory $inventory): static
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getEditor(): ?User
    {
        return $this->editor;
    }

    public function setEditor(?User $editor): static
    {
        $this->editor = $editor;

        return $this;
    }
}
