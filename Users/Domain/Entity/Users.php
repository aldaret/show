<?php

declare(strict_types=1);

namespace App\Users\Domain\Entity;

use App\Users\Domain\Service\UsersPasswordHasherInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer', unique: true)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private int $id;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private string $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $password;

    #[ORM\Column(type: 'string', length: 50)]
    private string $name;

    #[ORM\Column(type: 'integer', length: 3)]
    private int $age;

    #[ORM\Column(type: 'simple_array')]
    private array $roles;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setPassword(string $password, UsersPasswordHasherInterface $userPasswordHasher): void
    {
        $this->password = $userPasswordHasher->hash($this, $password);
    }

    public function setCreatedAt(\DateTimeImmutable $dateTimeImmutable): void
    {
        $this->createdAt = $dateTimeImmutable;
    }

    public function setUpdatedAt(\DateTimeImmutable $dateTimeImmutable): void
    {
        $this->updatedAt = $dateTimeImmutable;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

}
