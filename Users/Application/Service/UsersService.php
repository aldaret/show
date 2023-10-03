<?php
declare(strict_types=1);

namespace App\Users\Application\Service;

use App\Users\Application\DTO\UsersDTO;
use App\Users\Application\DTO\UsersDTOList;
use App\Users\Application\Exception\UserAlreadyExistsException;
use App\Users\Application\Exception\UsersNotFoundException;
use App\Users\Domain\Entity\Users;
use App\Users\Domain\Factory\UsersFactoryInterface;
use App\Users\Domain\Repository\UsersRepositoryInterface;
use App\Users\Domain\Service\UsersServiceInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

class UsersService implements UsersServiceInterface
{
    public function __construct(
        private UsersRepositoryInterface $usersRepository,
        private UsersFactoryInterface $usersFactory,
        private AuthenticationSuccessHandler $authenticationSuccessHandler
    ) {
    }

    public function setUsers(UsersDTO $usersDTO): Response
    {
        if($this->usersRepository->existsByEmail($usersDTO->getEmail())){
            throw new UserAlreadyExistsException();
        }
        $user = $this->usersFactory->create($usersDTO);

        return $this->authenticationSuccessHandler->handleAuthenticationSuccess(
            $this->usersRepository->add($user)
        );
    }

    public function getUsers(): UsersDTOList
    {
        $users = $this->usersRepository->getUsers();

        if (empty($users)) {
            throw new UsersNotFoundException();
        }

        $items = array_map(
            [$this, 'map'],
            $users
        );

        return new UsersDTOList($items);
    }

    public function getUserById(int $id): UsersDTO
    {
        $user = $this->usersRepository->findById($id);
        if (null === $user) {
            throw new UsersNotFoundException();
        }

        return $this->map($user);
    }

//    public function getUsersByCategory(int $categoryId): UsersDTOList
//    {
//        // TODO: Implement getUsersByCategory() method.
//    }

    public function existUserById(int $id): bool
    {
        return $this->usersRepository->existsById($id);
    }

    private function map(Users $users): UsersDTO
    {
        $dto = new UsersDTO();
        $dto->setId($users->getId());
        $dto->setEmail($users->getEmail());
        $dto->setName($users->getName());
        $dto->setAge($users->getAge());
        $dto->setCreatedAt($users->getCreatedAt());
        $dto->setUpdatedAt($users->getUpdatedAt());

        return $dto;
    }
}