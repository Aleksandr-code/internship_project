<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_USER = 'ROLE_USER';
    #[Groups(groups: ['user:info'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Groups(groups: ['user:info', 'inventory:access'])]
    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[Groups(groups: ['user:info'])]
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    /**
     * @var Collection<int, Inventory>
     */
    #[ORM\OneToMany(targetEntity: Inventory::class, mappedBy: 'owner')]
    private Collection $inventories;

    #[Groups(groups: ['user:info'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $isBlocked = 0;

    /**
     * @var Collection<int, InventoryAccess>
     */
    #[ORM\OneToMany(targetEntity: InventoryAccess::class, mappedBy: 'editor')]
    private Collection $inventoryAccesses;

    public function __construct()
    {
        $this->inventories = new ArrayCollection();
        $this->inventoryAccesses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = self::ROLE_USER;

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function isUserAdmin(): bool
    {
        return in_array(self::ROLE_ADMIN, $this->roles, true);
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Ensure the session doesn't contain actual password hashes by CRC32C-hashing them, as supported since Symfony 7.3.
     */
    public function __serialize(): array
    {
        $data = (array) $this;
        $data["\0".self::class."\0password"] = hash('crc32c', $this->password);

        return $data;
    }

    #[\Deprecated]
    public function eraseCredentials(): void
    {
        // @deprecated, to be removed when upgrading to Symfony 8
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
            $inventory->setOwner($this);
        }

        return $this;
    }

    public function removeInventory(Inventory $inventory): static
    {
        if ($this->inventories->removeElement($inventory)) {
            // set the owning side to null (unless already changed)
            if ($inventory->getOwner() === $this) {
                $inventory->setOwner(null);
            }
        }

        return $this;
    }

    public function getIsBlocked(): ?int
    {
        return $this->isBlocked;
    }

    public function setIsBlocked(?int $isBlocked): static
    {
        $this->isBlocked = $isBlocked;

        return $this;
    }

    /**
     * @return Collection<int, InventoryAccess>
     */
    public function getInventoryAccesses(): Collection
    {
        return $this->inventoryAccesses;
    }

//    public function addInventoryAccess(InventoryAccess $inventoryAccess): static
//    {
//        if (!$this->inventoryAccesses->contains($inventoryAccess)) {
//            $this->inventoryAccesses->add($inventoryAccess);
//            $inventoryAccess->setEditor($this);
//        }
//
//        return $this;
//    }
//
//    public function removeInventoryAccess(InventoryAccess $inventoryAccess): static
//    {
//        if ($this->inventoryAccesses->removeElement($inventoryAccess)) {
//            // set the owning side to null (unless already changed)
//            if ($inventoryAccess->getEditor() === $this) {
//                $inventoryAccess->setEditor(null);
//            }
//        }
//
//        return $this;
//    }
}
