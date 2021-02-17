<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser\Specifications;

use App\Code\V1\Users\Domain\CreateUser\Services\GetUserServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class UserExistsSpecification
{
    private GetUserServiceInterface $getUserService;

    public function __construct(GetUserServiceInterface $getUserService)
    {
        $this->getUserService = $getUserService;
    }

    public function isSatisfiedBy(string $email): bool
    {
        try {
            $this->getUserService->getUserByEmail($email);
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }
}
