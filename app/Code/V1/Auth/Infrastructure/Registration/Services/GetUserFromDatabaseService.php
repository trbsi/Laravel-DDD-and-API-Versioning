<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Infrastructure\Registration\Services;

use App\Code\V1\Auth\Domain\Registration\Services\GetUserServiceInterface;
use App\Models\User;

final class GetUserFromDatabaseService implements GetUserServiceInterface
{
    public function getUserByEmail(string $email): User
    {
        return User::where('email', $email)->firstOrFail();
    }
}
