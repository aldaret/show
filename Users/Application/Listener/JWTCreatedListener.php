<?php
declare(strict_types=1);

namespace App\Users\Application\Listener;

use App\Users\Domain\Entity\Users;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function __invoke(JWTCreatedEvent $event): void
    {
        /** @var Users $user */
        $user = $event->getUser();
        $payLoad = $event->getData();
        
        $payLoad['id'] = $user->getId();

        $event->setData($payLoad);
    }
}