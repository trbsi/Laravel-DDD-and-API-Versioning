<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\ReadUser;

use App\Code\V1\Users\Domain\ReadUser\Services\ReadUserServiceInterface;
use App\Code\V1\Users\Domain\ReadUser\Specifications\IsUserEmailVerifiedSpecification;
use App\Models\User;
use Exception;

final class ReadUserBusinessLogic
{
    private IsUserEmailVerifiedSpecification $isUserEmailVerifiedSpecification;
    private ReadUserServiceInterface $readUserService;

    public function __construct(
        IsUserEmailVerifiedSpecification $isUserEmailVerifiedSpecification,
        ReadUserServiceInterface $readUserService
    ) {
        $this->isUserEmailVerifiedSpecification = $isUserEmailVerifiedSpecification;
        $this->readUserService = $readUserService;
    }

    public function read(int $id): User
    {
        $user = $this->readUserService->readUser($id);

        if (!$this->isUserEmailVerifiedSpecification->isSatisifedBy($user)) {
            throw new Exception(__('v1/users/read_user.email_not_verified'), 400);
        }

        return $user;
    }
}
