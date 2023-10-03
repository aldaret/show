<?php

declare(strict_types=1);

namespace App\Users\Domain\Service;

use App\Users\Domain\Entity\Users;

interface UsersPasswordHasherInterface
{
    public function hash(Users $users, string $password): string;
}
