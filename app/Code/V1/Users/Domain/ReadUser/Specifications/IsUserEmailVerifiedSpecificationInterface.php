<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\ReadUser\Specifications;

use App\Models\User;

interface IsUserEmailVerifiedSpecificationInterface
{
    public function isSatisifedBy(User $user): bool;
}