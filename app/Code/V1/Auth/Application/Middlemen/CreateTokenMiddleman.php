<?php
declare(strict_types=1);

namespace App\Code\V1\Auth\Application\Middlemen;

use App\Code\V1\Auth\Domain\CreateToken\CreateTokenBusinessLogic;

final class CreateTokenMiddleman
{
    private CreateTokenBusinessLogic $createTokenBusinessLogic;

    public function __construct(CreateTokenBusinessLogic $createTokenBusinessLogic)
    {
        $this->createTokenBusinessLogic = $createTokenBusinessLogic;
    }

    public function createToken(string $email, string $password): string
    {
        return $this->createTokenBusinessLogic->createToken($email, $password);
    }
}
