<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[Groups(groups: ['inventory:main', 'tag:list'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Groups(groups: ['inventory:main', 'tag:list'])]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    /**
     * @var Collection<int, Inventory>
     */
    #[ORM\ManyToMany(targetEntity: Inventory::class, mappedBy: 'tags')]
    private Collection $inventories;

    public function __construct()
    {
        $this->inventories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection<int, Inventory>
     */
    public function getInventories(): Collection
    {
        return $this->inventories;
    }

    public function addInventory(Inventory $inventory): static
    {
        if (!$this->inventories->contains($inventory)) {
            $this->inventories->add($inventory);
            $inventory->addTag($this);
        }

        return $this;
    }

    public function removeInventory(Inventory $inventory): static
    {
        if ($this->inventories->removeElement($inventory)) {
            $inventory->removeTag($this);
        }

        return $this;
    }
}
