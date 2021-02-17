<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Application\Middlemen;

use App\Code\V1\Users\Domain\CreateUser\CreateUserBusinessLogic;
use App\Models\User;

final class CreateUserMiddleman
{
    private CreateUserBusinessLogic $createUserBusinessLogic;

    public function __construct(CreateUserBusinessLogic $createUserBusinessLogic)
    {
        $this->createUserBusinessLogic = $createUserBusinessLogic;
    }

    public function create(string $name, string $password, string $email): User
    {
        return $this->createUserBusinessLogic->create($name, $password, $email);
    }
}