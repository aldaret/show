<?php
declare(strict_types=1);

namespace App\Users\Domain\Service;

use App\Users\Application\DTO\UsersDTO;
use App\Users\Application\DTO\UsersDTOList;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Uid\Uuid;

interface UsersServiceInterface
{
    public function setUsers(UsersDTO $usersDTO): Response;

    public function getUsers(): UsersDTOList;

    public function getUserById(int $id): UsersDTO;

//    public function getUsersByCategory(int $categoryId): UsersDTOList;

    public function existUserById(int $id): bool;
}