<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Domain\Registration\Services;

use App\Models\User;

interface SaveUserInterface
{
    public function saveUser(string $email, string $password, string $name): User;
}
