<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class UserController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
        private SerializerInterface $serializer,
        private UserService $userService)
    {
    }

    #[Route('/api/admin/users', name: 'app_admin_users_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $users = $this->em->getRepository(User::class)->findAll();

        $userSerialize = $this->serializer->serialize($users, 'json' ,['groups' => ['user:info']]);

        return new JsonResponse($userSerialize, 200, [], true);
    }
    #[Route('/api/admin/users/block', name: 'app_admin_users_block', methods: ['POST'])]
    public function setBlockStatus(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->userService->changeBlockStatus($data, 1);

        return new JsonResponse(['message' => 'users blocked'], 200, [], false);
    }

    #[Route('/api/admin/users/unlock', name: 'app_admin_users_unlock', methods: ['POST'])]
    public function setUnlockStatus(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->userService->changeBlockStatus($data, 0);

        return new JsonResponse(['message' => 'users unlocked'], 200, [], false);
    }

    #[Route('/api/admin/users/destroy', name: 'app_admin_users_delete', methods: ['POST'])]
    public function destroy(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $this->userService->destroy($data);

        return new JsonResponse(['message' => 'deleted'], 200, []);
    }
}
