<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Domain\Registration\Specifications;

use App\Code\V1\Auth\Domain\Registration\Services\GetUserServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class UserWithEmailExistsSpecification
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
        } catch (ModelNotFoundException $exception) {
            return false;
        }
    }
}
