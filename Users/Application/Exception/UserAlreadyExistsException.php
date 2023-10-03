<?php
declare(strict_types=1);

namespace App\Users\Application\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class UserAlreadyExistsException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('User Already Exists', Response::HTTP_CONFLICT);
    }
}