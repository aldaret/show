<?php
declare(strict_types=1);

namespace App\Users\Domain\Service;

interface RoleServiceInteraface
{
    public function addAdminRole(int $userId): void;

    public function addAuthorRole(int $userId): void;
}