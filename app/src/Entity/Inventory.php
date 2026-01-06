<?php

namespace App\Entity;

use App\Repository\InventoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: InventoryRepository::class)]
class Inventory
{
    #[Groups(groups: ['inventory:main'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[Groups(groups: ['inventory:main'])]
    #[ORM\Column(length: 255)]
    private ?string $title = null;
    #[Groups(groups: ['inventory:main'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;
    #[Groups(groups: ['inventory:main'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;
    #[Groups(groups: ['inventory:main'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;
    #[Groups(groups: ['inventory:main'])]
    #[ORM\ManyToOne(inversedBy: 'inventories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, Tag>
     */
    #[Groups(groups: ['inventory:main'])]
    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'inventories')]
    private Collection $tags;

    #[Groups(groups: ['inventory:main'])]
    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $isPublic = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customString1State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customString1Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customString2State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customString2Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customString3State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customString3Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customText1State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customText1Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customText2State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customText2Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customText3State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customText3Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customInt1State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customInt1Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customInt2State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customInt2Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customInt3State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customInt3Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customFile1State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customFile1Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customFile2State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customFile2Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customFile3State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customFile3Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customBool1State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customBool1Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customBool2State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customBool2Name = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $customBool3State = null;
    #[Groups(groups: ['inventory:fields'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $customBool3Name = null;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getIsPublic(): ?int
    {
        return $this->isPublic;
    }

    public function setIsPublic(int $isPublic): static
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getCustomString1State(): ?int
    {
        return $this->customString1State;
    }

    public function setCustomString1State(?int $customString1State): static
    {
        $this->customString1State = $customString1State;

        return $this;
    }

    public function getCustomString1Name(): ?string
    {
        return $this->customString1Name;
    }

    public function setCustomString1Name(?string $customString1Name): static
    {
        $this->customString1Name = $customString1Name;

        return $this;
    }

    public function getCustomString2State(): ?int
    {
        return $this->customString2State;
    }

    public function setCustomString2State(?int $customString2State): static
    {
        $this->customString2State = $customString2State;

        return $this;
    }

    public function getCustomString2Name(): ?string
    {
        return $this->customString2Name;
    }

    public function setCustomString2Name(?string $customString2Name): static
    {
        $this->customString2Name = $customString2Name;

        return $this;
    }

    public function getCustomString3State(): ?int
    {
        return $this->customString3State;
    }

    public function setCustomString3State(?int $customString3State): static
    {
        $this->customString3State = $customString3State;

        return $this;
    }

    public function getCustomString3Name(): ?string
    {
        return $this->customString3Name;
    }

    public function setCustomString3Name(?string $customString3Name): static
    {
        $this->customString3Name = $customString3Name;

        return $this;
    }

    public function getCustomText1State(): ?int
    {
        return $this->customText1State;
    }

    public function setCustomText1State(?int $customText1State): static
    {
        $this->customText1State = $customText1State;

        return $this;
    }

    public function getCustomText1Name(): ?string
    {
        return $this->customText1Name;
    }

    public function setCustomText1Name(?string $customText1Name): static
    {
        $this->customText1Name = $customText1Name;

        return $this;
    }

    public function getCustomText2State(): ?int
    {
        return $this->customText2State;
    }

    public function setCustomText2State(?int $customText2State): static
    {
        $this->customText2State = $customText2State;

        return $this;
    }

    public function getCustomText2Name(): ?string
    {
        return $this->customText2Name;
    }

    public function setCustomText2Name(?string $customText2Name): static
    {
        $this->customText2Name = $customText2Name;

        return $this;
    }

    public function getCustomText3State(): ?int
    {
        return $this->customText3State;
    }

    public function setCustomText3State(?int $customText3State): static
    {
        $this->customText3State = $customText3State;

        return $this;
    }

    public function getCustomText3Name(): ?string
    {
        return $this->customText3Name;
    }

    public function setCustomText3Name(?string $customText3Name): static
    {
        $this->customText3Name = $customText3Name;

        return $this;
    }

    public function getCustomInt1State(): ?int
    {
        return $this->customInt1State;
    }

    public function setCustomInt1State(?int $customInt1State): static
    {
        $this->customInt1State = $customInt1State;

        return $this;
    }

    public function getCustomInt1Name(): ?string
    {
        return $this->customInt1Name;
    }

    public function setCustomInt1Name(?string $customInt1Name): static
    {
        $this->customInt1Name = $customInt1Name;

        return $this;
    }

    public function getCustomInt2State(): ?int
    {
        return $this->customInt2State;
    }

    public function setCustomInt2State(?int $customInt2State): static
    {
        $this->customInt2State = $customInt2State;

        return $this;
    }

    public function getCustomInt2Name(): ?string
    {
        return $this->customInt2Name;
    }

    public function setCustomInt2Name(?string $customInt2Name): static
    {
        $this->customInt2Name = $customInt2Name;

        return $this;
    }

    public function getCustomInt3State(): ?int
    {
        return $this->customInt3State;
    }

    public function setCustomInt3State(?int $customInt3State): static
    {
        $this->customInt3State = $customInt3State;

        return $this;
    }

    public function getCustomInt3Name(): ?string
    {
        return $this->customInt3Name;
    }

    public function setCustomInt3Name(?string $customInt3Name): static
    {
        $this->customInt3Name = $customInt3Name;

        return $this;
    }

    public function getCustomFile1State(): ?int
    {
        return $this->customFile1State;
    }

    public function setCustomFile1State(?int $customFile1State): static
    {
        $this->customFile1State = $customFile1State;

        return $this;
    }

    public function getCustomFile1Name(): ?string
    {
        return $this->customFile1Name;
    }

    public function setCustomFile1Name(?string $customFile1Name): static
    {
        $this->customFile1Name = $customFile1Name;

        return $this;
    }

    public function getCustomFile2State(): ?int
    {
        return $this->customFile2State;
    }

    public function setCustomFile2State(?int $customFile2State): static
    {
        $this->customFile2State = $customFile2State;

        return $this;
    }

    public function getCustomFile2Name(): ?string
    {
        return $this->customFile2Name;
    }

    public function setCustomFile2Name(?string $customFile2Name): static
    {
        $this->customFile2Name = $customFile2Name;

        return $this;
    }

    public function getCustomFile3State(): ?int
    {
        return $this->customFile3State;
    }

    public function setCustomFile3State(?int $customFile3State): static
    {
        $this->customFile3State = $customFile3State;

        return $this;
    }

    public function getCustomFile3Name(): ?string
    {
        return $this->customFile3Name;
    }

    public function setCustomFile3Name(?string $customFile3Name): static
    {
        $this->customFile3Name = $customFile3Name;

        return $this;
    }

    public function getCustomBool1State(): ?int
    {
        return $this->customBool1State;
    }

    public function setCustomBool1State(?int $customBool1State): static
    {
        $this->customBool1State = $customBool1State;

        return $this;
    }

    public function getCustomBool1Name(): ?string
    {
        return $this->customBool1Name;
    }

    public function setCustomBool1Name(?string $customBool1Name): static
    {
        $this->customBool1Name = $customBool1Name;

        return $this;
    }

    public function getCustomBool2State(): ?int
    {
        return $this->customBool2State;
    }

    public function setCustomBool2State(?int $customBool2State): static
    {
        $this->customBool2State = $customBool2State;

        return $this;
    }

    public function getCustomBool2Name(): ?string
    {
        return $this->customBool2Name;
    }

    public function setCustomBool2Name(?string $customBool2Name): static
    {
        $this->customBool2Name = $customBool2Name;

        return $this;
    }

    public function getCustomBool3State(): ?int
    {
        return $this->customBool3State;
    }

    public function setCustomBool3State(?int $customBool3State): static
    {
        $this->customBool3State = $customBool3State;

        return $this;
    }

    public function getCustomBool3Name(): ?string
    {
        return $this->customBool3Name;
    }

    public function setCustomBool3Name(?string $customBool3Name): static
    {
        $this->customBool3Name = $customBool3Name;

        return $this;
    }

}
