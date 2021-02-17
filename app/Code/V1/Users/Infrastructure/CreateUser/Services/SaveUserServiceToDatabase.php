<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Infrastructure\CreateUser\Services;

use App\Code\V1\Users\Domain\CreateUser\Services\SaveUserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class SaveUserServiceToDatabase implements SaveUserServiceInterface
{
    public function save(string $name, string $password, string $email): User
    {
        $user = new User();
        $user
            ->setEmail($email)
            ->setName($name)
            ->setPassword(Hash::make($password));

        $user->save();

        return $user;
    }
}