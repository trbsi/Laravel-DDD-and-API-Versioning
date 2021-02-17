<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser\Specifications;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class UserExistsSpecification
{
    public function isSatisfiedBy(string $email): bool
    {
        try {
            User::where('email', $email)->firstOrFail();
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}
