<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\ReadUser\Services;

use App\Models\User;

interface ReadUserServiceInterface
{
    public function readUser(int $id): User;
}
