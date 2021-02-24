<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Domain\Registration;

use App\Code\V1\Auth\Domain\Registration\Services\SaveUserInterface;
use App\Code\V1\Auth\Domain\Registration\Specifications\UserWithEmailExistsSpecification;
use App\Models\User;
use Exception;

final class RegistrationBusinessLogic
{
    private UserWithEmailExistsSpecification $userWithEmailExistsSpecification;
    private SaveUserInterface $saveUser;

    public function __construct(
        UserWithEmailExistsSpecification $userWithEmailExistsSpecification,
        SaveUserInterface $saveUser
    ) {
        $this->userWithEmailExistsSpecification = $userWithEmailExistsSpecification;
        $this->saveUser = $saveUser;
    }

    /**
     * @throws Exception
     */
    public function logic(string $email, string $name, string $password): User
    {
        $this->checkIfUserExists($email);

        return $this->saveUser->saveUser($email, $password, $name);
    }

    private function checkIfUserExists(string $email): void
    {
        if (true === $this->userWithEmailExistsSpecification->isSatisfiedBy($email)) {
            throw new Exception(__('v1/auth/registration.user_with_email_exists'), 400);
        }
    }
}
