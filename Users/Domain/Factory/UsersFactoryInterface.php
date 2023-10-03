<?php
declare(strict_types=1);

namespace App\Users\Domain\Factory;

use App\Users\Application\DTO\UsersDTO;
use App\Users\Domain\Entity\Users;

interface UsersFactoryInterface
{
    public function find(UsersDTO $usersDTO): Users;

    public function create(UsersDTO $usersDTO): Users;
}