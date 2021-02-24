<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Application\Middlemen;

use App\Code\V1\Auth\Domain\Registration\RegistrationBusinessLogic;
use App\Models\User;

final class RegistrationMiddleman
{
    private RegistrationBusinessLogic $registrationBusinessLogic;

    public function __construct(RegistrationBusinessLogic $registrationBusinessLogic)
    {
        $this->registrationBusinessLogic = $registrationBusinessLogic;
    }

    public function mediate(string $email, string $name, string $password): User
    {
        return $this->registrationBusinessLogic->logic($email, $name, $password);
    }
}
