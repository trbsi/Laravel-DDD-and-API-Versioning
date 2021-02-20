<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Infrastructure\ReadUser\Services;

use App\Code\V1\Users\Domain\ReadUser\Services\ReadUserServiceInterface;
use App\Models\User;

final class GetUserFromDatabaseService implements ReadUserServiceInterface
{
    public function readUser(int $id): User
    {
        return User::findOrFail($id);
    }
}
