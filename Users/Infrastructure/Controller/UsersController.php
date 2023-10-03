<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Users\Application\DTO\UsersDTO;
use App\Users\Domain\Service\UsersServiceInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UsersController extends AbstractController
{
    public int $code = Response::HTTP_OK;

    public function __construct(
        private UsersServiceInterface $usersService
    ) {
    }

    #[Route('/api/v1/users', name: 'users_index', methods: ['GET'])]
    public function getUsers(): Response
    {
        try {
            $answer = $this->usersService->getUsers();
        }catch (Exception $e){
            $answer = $e->getMessage();
            $this->code = $e->getCode();
        }

        return $this->json(
            ['result' => $answer],
            $this->code
        );
    }

    #[Route('/api/v1/auth/signUp', name: 'users_create', methods: ['POST'])]
    public function addUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $usersDTO = new UsersDTO();
        $usersDTO->setEmail($data['email']);
        $usersDTO->setName($data['name']);
        $usersDTO->setAge($data['age']);
        $usersDTO->setPassword($data['password']);

        try {
            $answer = $this->usersService->setUsers($usersDTO);
            $this->code = Response::HTTP_CREATED;
        }catch (Exception $e){
            $answer = $e->getMessage();
            $this->code = $e->getCode();
        }

        return $this->json(
            ['result' => $answer->getContent()],
            $this->code
        );
    }

    #[Route('/api/v1/users/{id}', name: 'users_by_id', methods: ['GET'])]
    public function getUserById(int $id): Response
    {
        try {
            $answer = $this->usersService->getUserById($id);
        }catch (Exception $e){
            $answer = $e->getMessage();
            $this->code = $e->getCode();
        }

        return $this->json(
            ['result' => $answer],
            $this->code
        );
    }

    #[Route('/api/v1/user/me', name: 'user_auth', methods: ['GET'])]
    public function getUserByToken(UserInterface $user): Response
    {
        return $this->json(
            ['result' => $user],
            $this->code
        );
    }
}
