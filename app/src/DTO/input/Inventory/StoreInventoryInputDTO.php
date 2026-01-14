<?php

namespace App\DTO\input\Inventory;

use App\DTO\input\InputDTO;
use Symfony\Component\Validator\Constraints as Assert;

class StoreInventoryInputDTO implements InputDTO
{
    #[Assert\NotBlank(allowNull: false, normalizer:'trim')]
    #[Assert\Length(min: 1, max: 255)]
    public ?string $title = null;

    #[Assert\NotBlank(allowNull: false, normalizer:'trim')]
    public ?string $description = null;

    #[Assert\Url]
    public ?string $imageUrl = null;

    #[Assert\Type(\DateTimeImmutable::class)]
    public ?\DateTimeImmutable $createdAt = null;

    #[Assert\NotNull]
    #[Assert\Type(type: 'integer')]
    public ?int $categoryId = null;

    #[Assert\Type(type: 'array')]
    public array $tags;

}
