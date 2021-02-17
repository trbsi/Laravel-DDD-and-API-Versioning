<?php 
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\ReadUser;

use App\Code\V1\Users\Domain\ReadUser\Specifications\IsUserEmailVerifiedSpecificationInterface;
use App\Models\User;
use Exception;

final class ReadUserBusinessLogic
{
    private IsUserEmailVerifiedSpecificationInterface $isUserEmailVerifiedSpecification;

    public function __construct(
        IsUserEmailVerifiedSpecificationInterface $isUserEmailVerifiedSpecification
    ) {
        $this->isUserEmailVerifiedSpecification = $isUserEmailVerifiedSpecification;
    }

    public function read(int $id): User
    {
        $user = User::find($id);

        if ($this->isUserEmailVerifiedSpecification->isSatisifedBy($user)) {
            throw new Exception('Email is not verified', 400);
        }
    }
}