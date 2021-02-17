<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser\Services;

use App\Models\User;

interface GetUserServiceInterface
{
    public function getUserByEmail(string $email): User;
}
