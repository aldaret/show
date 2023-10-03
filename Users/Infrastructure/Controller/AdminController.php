<?php
declare(strict_types=1);

namespace App\Users\Infrastructure\Controller;

use App\Users\Domain\Service\RoleServiceInteraface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public int $code = Response::HTTP_OK;

    public function __construct(
        private RoleServiceInteraface $roleService
    )
    {
    }

    #[Route('/api/v1/admin/addAuthorRole/{userId}', name: 'admin_add_author_role', methods: ['POST'])]
    public function addAuthorRole(int $userId): Response
    {
        try {
            $this->roleService->addAuthorRole($userId);
            $answer = 'ok';
        }catch (Exception $e){
            $answer = $e->getMessage();
            $this->code = $e->getCode();
        }

        return $this->json(
            ['result' => $answer],
            $this->code
        );
    }
}