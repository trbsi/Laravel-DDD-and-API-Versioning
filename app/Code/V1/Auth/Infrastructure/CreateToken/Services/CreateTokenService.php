<?php
declare(strict_types=1);

namespace App\Code\V1\Auth\Infrastructure\CreateToken\Services;

use App\Code\V1\Auth\Domain\CreateToken\Interfaces\CreateTokenInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class CreateTokenService implements CreateTokenInterface
{
    public function createToken(string $email, string $password): string
    {
        /** @var User $user */
        $user = User::where('email', $email)->first();

        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages(['The provided credentials are incorrect.']);
        }

        return $user->createToken($user->getEmail())->plainTextToken;
    }
}
