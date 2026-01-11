<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class AuthController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private JWTTokenManagerInterface $JWTTokenManager,
        private SerializerInterface $serializer,
    )
    {
    }

    #[Route('/api/auth/register', name: 'app_auth_register', methods: ['POST'])]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {

        $data = json_decode($request->getContent(), true);

        $user = new User();
        $user->setEmail($data['email']);
        $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        $this->em->persist($user);
        $this->em->flush();

        $userSerialize = $this->serializer->serialize(
            ['user' => $user, 'token' => $this->JWTTokenManager->create($user)],
            'json',
            ['groups' => ['user:info']]);

        return new JsonResponse($userSerialize, 200, [], true);
    }

    #[Route('/api/auth/me', name: 'app_auth_me', methods: ['POST'])]
    public function me(): JsonResponse
    {
        $user = $this->getUser();

        $userSerialize = $this->serializer->serialize($user, 'json', ['groups' => ['user:info']]);

        return new JsonResponse($userSerialize, 200, [], true);
    }
}
