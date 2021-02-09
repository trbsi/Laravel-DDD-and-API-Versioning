<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser\Interfaces;

use App\Models\User;

interface SaveUserInterface
{
    public function save(string $name, string $password, string $email): User;
}