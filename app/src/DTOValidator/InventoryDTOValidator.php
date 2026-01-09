<?php

declare(strict_types=1);

namespace App\DTOValidator;

use App\DTO\input\Inventory\StoreInventoryInputDTO;
use App\DTO\input\Inventory\UpdateInventoryInputDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class InventoryDTOValidator
{
    public function __construct(
        private ValidatorInterface $validator
    )
    {
    }

    public function validate(StoreInventoryInputDTO|UpdateInventoryInputDTO $inventory):JsonResponse|null
    {
        $errors = $this->validator->validate($inventory);
        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()][] = $error->getMessage();
            }
            return new JsonResponse($messages, status: 422);
        }
        return null;

    }
}
