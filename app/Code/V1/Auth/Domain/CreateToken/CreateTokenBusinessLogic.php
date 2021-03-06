<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Domain\CreateToken;

use App\Code\V1\Auth\Domain\CreateToken\Services\CreateTokenServiceInterface;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

final class CreateTokenBusinessLogic
{
    private CreateTokenServiceInterface $createToken;

    public function __construct(CreateTokenServiceInterface $createToken)
    {
        $this->createToken = $createToken;
    }

    public function createToken(string $email, string $password): string
    {
        try {
            return $this->createToken->createToken($email, $password);
        } catch (ValidationException $e) {
            //@TODO provjeriti koji exceptioni postoje u Laravelu
            throw new Exception(implode(' ', Arr::flatten($e->errors())), $e->status);
        }
    }
}
