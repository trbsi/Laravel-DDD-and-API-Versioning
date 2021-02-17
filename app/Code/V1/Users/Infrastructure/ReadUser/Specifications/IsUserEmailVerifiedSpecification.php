<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Infrastructure\ReadUser\Specifications;

use App\Code\V1\Users\Domain\ReadUser\Specifications\IsUserEmailVerifiedSpecificationInterface;
use App\Models\User;

final class IsUserEmailVerifiedSpecification implements IsUserEmailVerifiedSpecificationInterface
{
    public function isSatisifedBy(User $user): bool
    {
        if (null === $user->getEmailVerifiedAt()) {
            return false;
        }

        return true;
    }
}