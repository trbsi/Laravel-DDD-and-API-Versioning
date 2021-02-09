<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Application\Services;

use App\Code\V1\Users\Domain\CreateUser\Services\CreateUserService;
use App\Models\User;

final class CreateUserMiddleman
{
    private CreateUserService $createUserService;

    public function __construct(CreateUserService $createUserService)
    {
        $this->createUserService = $createUserService;
    }

    public function create(string $name, string $password, string $email): User
    {
        return $this->createUserService->create($name, $password, $email);
    }
}