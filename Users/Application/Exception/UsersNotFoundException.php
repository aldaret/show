<?php
declare(strict_types=1);

namespace App\Users\Application\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class UsersNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('Users Not Found', Response::HTTP_NOT_FOUND);
    }
}