<?php

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\Users;
use Symfony\Component\Uid\Uuid;

interface UsersRepositoryInterface
{
    public function add(Users $user): Users;

    public function findById(int $id): ?Users;

    public function findByEmail(string $email): ?Users;

    public function getUsers(): array;

    public function existsById(int $id): bool;

    public function existsByEmail(string $email): bool;
}
