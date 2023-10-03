<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Repository;

use App\Users\Domain\Entity\Users;
use App\Users\Domain\Repository\UsersRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

class UsersRepository extends ServiceEntityRepository implements UsersRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function add(Users $user): Users
    {
        $this->_em->persist($user);
        $this->_em->flush();

        return $this->findById($user->getId());
    }

    public function findById(int $id): ?Users
    {
        return $this->find($id);
    }

    public function findByEmail(string $email): ?Users
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function getUsers(): array
    {
        return $this->findAll();
    }

    public function existsById(int $id): bool
    {
        return null !== $this->find($id);
    }

    public function existsByEmail(string $email): bool
    {
        return null !== $this->findOneBy(['email' => $email]);
    }
}
