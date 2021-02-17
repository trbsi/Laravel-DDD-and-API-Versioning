<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser\Services;

use App\Models\User;

interface SaveUserServiceInterface
{
    public function save(string $name, string $password, string $email): User;
}
