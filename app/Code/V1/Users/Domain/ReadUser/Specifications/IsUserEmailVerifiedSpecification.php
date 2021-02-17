<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\ReadUser\Specifications;

use App\Models\User;

final class IsUserEmailVerifiedSpecification
{
    public function isSatisifedBy(User $user): bool
    {
        if (null === $user->getEmailVerifiedAt()) {
            return false;
        }

        return true;
    }
}
