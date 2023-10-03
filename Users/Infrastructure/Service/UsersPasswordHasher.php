<?php

declare(strict_types=1);

namespace App\Users\Infrastructure\Service;

use App\Users\Domain\Entity\Users;
use App\Users\Domain\Service\UsersPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as BaseUserPasswordHasherInterface;

class UsersPasswordHasher implements UsersPasswordHasherInterface
{
    public function __construct(
        private BaseUserPasswordHasherInterface $userPasswordHasher
    )
    {
    }

    public function hash(Users $users, string $password): string
    {
        return $this->userPasswordHasher->hashPassword($users, $password);
    }
}
