<?php

namespace App\DTO\input\InventoryItem;

use App\DTO\input\InputDTO;
use Symfony\Component\Validator\Constraints as Assert;

class StoreInventoryItemInputDTO implements InputDTO
{
    #[Assert\Type(type: 'string')]
    public ?string $string1Value = null;
    #[Assert\Type(type: 'string')]
    public ?string $string2Value = null;
    #[Assert\Type(type: 'string')]
    public ?string $string3Value = null;
    #[Assert\Type(type: 'string')]
    public ?string $text1Value = null;
    #[Assert\Type(type: 'string')]
    public ?string $text2Value = null;
    #[Assert\Type(type: 'string')]
    public ?string $text3Value = null;
    #[Assert\Type(type: 'integer')]
    public ?int $int1Value = null;
    #[Assert\Type(type: 'integer')]
    public ?int $int2Value = null;
    #[Assert\Type(type: 'integer')]
    public ?int $int3Value = null;
    #[Assert\Type(type: 'string')]
    public ?string $file1Value = null;
    #[Assert\Type(type: 'string')]
    public ?string $file2Value = null;
    #[Assert\Type(type: 'string')]
    public ?string $file3Value = null;
    #[Assert\Type(type: 'boolean')]
    public ?bool $bool1Value = null;
    #[Assert\Type(type: 'boolean')]
    public ?bool $bool2Value = null;
    #[Assert\Type(type: 'boolean')]
    public ?bool $bool3Value = null;

}
