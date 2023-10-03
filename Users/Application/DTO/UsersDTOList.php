<?php

declare(strict_types=1);

namespace App\Users\Application\DTO;

class UsersDTOList
{
    /**
     * @var UsersDTO[]
     */
    private array $items;

    /**
     * @param UsersDTO[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return UsersDTO[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
