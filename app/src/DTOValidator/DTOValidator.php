<?php

declare(strict_types=1);

namespace App\DTOValidator;

use App\DTO\input\InputDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DTOValidator
{
    public function __construct(
        private ValidatorInterface $validator
    )
    {
    }

    public function validate(InputDTO $inputDTO):JsonResponse|null
    {
        $errors = $this->validator->validate($inputDTO);
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
