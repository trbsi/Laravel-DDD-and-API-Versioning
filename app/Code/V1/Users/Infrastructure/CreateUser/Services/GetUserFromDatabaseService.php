<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Infrastructure\CreateUser\Services;

use App\Code\V1\Users\Domain\CreateUser\Services\GetUserServiceInterface;
use App\Models\User;

final class GetUserFromDatabaseService implements GetUserServiceInterface
{
    public function getUserByEmail(string $email): User
    {
        return User::where('email', $email)->firstOrFail();
    }
}
