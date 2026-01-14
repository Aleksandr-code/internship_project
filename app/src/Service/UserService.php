<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $em,
    )
    {
    }

    public function changeBlockStatus(array $data, int $isBlock):void
    {
        $this->userRepository->changeBlockedStatus($data['ids'], $isBlock);
    }

    public function destroy(array $data):void
    {
        $lastIndex = count($data['ids']) - 1;
        foreach ($data['ids'] as $key => $userId) {
            $user = $this->em->getReference(User::class, $userId);
            $this->userRepository->destroy($user, false);
            if($lastIndex === $key){
                $this->userRepository->destroy($user, true);
            }
        }
    }
}
