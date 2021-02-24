<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Infrastructure\Registration\Services;

use App\Code\V1\Auth\Domain\Registration\Services\SaveUserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class SaveUserToTheDatabase implements SaveUserInterface
{
    public function saveUser(string $email, string $password, string $name): User
    {
        $user = new User();
        $user
            ->setPassword(Hash::make($password))
            ->setName($name)
            ->setEmail($email)
        ;

        $user->save();

        return $user->fresh();
    }
}
