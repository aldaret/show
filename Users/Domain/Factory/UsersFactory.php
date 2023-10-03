<?php

declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Users\Application\DTO\UsersDTO;
use App\Users\Domain\Entity\Users;
use App\Users\Domain\Service\UsersPasswordHasherInterface;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;

class UsersFactory implements UsersFactoryInterface
{
    public function __construct(
        private UsersPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function find(UsersDTO $usersDTO): Users
    {
        return $this->entityManager->find(Users::class, $usersDTO->getId());
    }

    public function create(UsersDTO $usersDTO): Users
    {
        $user = new Users();
        $dateTime = new \DateTimeImmutable();
        $user->setRoles(['ROLE_USER']);
        $user->setAge($usersDTO->getAge());
        $user->setEmail($usersDTO->getEmail());
        $user->setName($usersDTO->getName());
        $user->setPassword($usersDTO->getPassword(), $this->passwordHasher);
        $user->setCreatedAt($dateTime);
        $user->setUpdatedAt($dateTime);

        return $user;
    }
}
