<?php
declare(strict_types=1);

namespace App\Users\Application\Service;

use App\Users\Domain\Repository\UsersRepositoryInterface;
use App\Users\Domain\Service\RoleServiceInteraface;
use Doctrine\ORM\EntityManagerInterface;

class RoleService implements RoleServiceInteraface
{
    public function __construct(
        private UsersRepositoryInterface $usersRepository,
        private EntityManagerInterface $em
    )
    {
    }

    public function addAdminRole(int $userId): void
    {
        $this->addRole($userId, 'ROLE_ADMIN');
    }

    public function addAuthorRole(int $userId): void
    {
        $this->addRole($userId, 'ROLE_AUTHOR');
    }

    private function addRole(int $userId, string $role): void
    {
        $user = $this->usersRepository->findById($userId);
        $user->setRoles([$role]);

        $this->em->flush();
    }
}