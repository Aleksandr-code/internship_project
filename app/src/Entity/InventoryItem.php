<?php

namespace App\Entity;

use App\Repository\InventoryItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: InventoryItemRepository::class)]
class InventoryItem
{
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'inventoryItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?inventory $inventory = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $string1Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $string2Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $string3Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text1Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text2Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $text3Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(nullable: true)]
    private ?int $int1Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(nullable: true)]
    private ?int $int2Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(nullable: true)]
    private ?int $int3Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file1Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file2Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $file3Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(nullable: true)]
    private ?bool $bool1Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(nullable: true)]
    private ?bool $bool2Value = null;
    #[Groups(groups: ['inventory:items'])]
    #[ORM\Column(nullable: true)]
    private ?bool $bool3Value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInventory(): ?inventory
    {
        return $this->inventory;
    }

    public function setInventory(?inventory $inventory): static
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getString1Value(): ?string
    {
        return $this->string1Value;
    }

    public function setString1Value(?string $string1Value): static
    {
        $this->string1Value = $string1Value;

        return $this;
    }

    public function getString2Value(): ?string
    {
        return $this->string2Value;
    }

    public function setString2Value(?string $string2Value): static
    {
        $this->string2Value = $string2Value;

        return $this;
    }

    public function getString3Value(): ?string
    {
        return $this->string3Value;
    }

    public function setString3Value(?string $string3Value): static
    {
        $this->string3Value = $string3Value;

        return $this;
    }

    public function getText1Value(): ?string
    {
        return $this->text1Value;
    }

    public function setText1Value(?string $text1Value): static
    {
        $this->text1Value = $text1Value;

        return $this;
    }

    public function getText2Value(): ?string
    {
        return $this->text2Value;
    }

    public function setText2Value(?string $text2Value): static
    {
        $this->text2Value = $text2Value;

        return $this;
    }

    public function getText3Value(): ?string
    {
        return $this->text3Value;
    }

    public function setText3Value(?string $text3Value): static
    {
        $this->text3Value = $text3Value;

        return $this;
    }

    public function getInt1Value(): ?int
    {
        return $this->int1Value;
    }

    public function setInt1Value(?int $int1Value): static
    {
        $this->int1Value = $int1Value;

        return $this;
    }

    public function getInt2Value(): ?int
    {
        return $this->int2Value;
    }

    public function setInt2Value(?int $int2Value): static
    {
        $this->int2Value = $int2Value;

        return $this;
    }

    public function getInt3Value(): ?int
    {
        return $this->int3Value;
    }

    public function setInt3Value(?int $int3Value): static
    {
        $this->int3Value = $int3Value;

        return $this;
    }

    public function getFile1Value(): ?string
    {
        return $this->file1Value;
    }

    public function setFile1Value(?string $file1Value): static
    {
        $this->file1Value = $file1Value;

        return $this;
    }

    public function getFile2Value(): ?string
    {
        return $this->file2Value;
    }

    public function setFile2Value(?string $file2Value): static
    {
        $this->file2Value = $file2Value;

        return $this;
    }

    public function getFile3Value(): ?string
    {
        return $this->file3Value;
    }

    public function setFile3Value(?string $file3Value): static
    {
        $this->file3Value = $file3Value;

        return $this;
    }

    public function isBool1Value(): ?bool
    {
        return $this->bool1Value;
    }

    public function setBool1Value(?bool $bool1Value): static
    {
        $this->bool1Value = $bool1Value;

        return $this;
    }

    public function isBool2Value(): ?bool
    {
        return $this->bool2Value;
    }

    public function setBool2Value(?bool $bool2Value): static
    {
        $this->bool2Value = $bool2Value;

        return $this;
    }

    public function isBool3Value(): ?bool
    {
        return $this->bool3Value;
    }

    public function setBool3Value(?bool $bool3Value): static
    {
        $this->bool3Value = $bool3Value;

        return $this;
    }
}
