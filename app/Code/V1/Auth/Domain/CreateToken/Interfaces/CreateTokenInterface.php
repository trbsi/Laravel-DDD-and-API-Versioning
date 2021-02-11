<?php
declare(strict_types=1);

namespace App\Code\V1\Auth\Domain\CreateToken\Interfaces;

interface CreateTokenInterface
{
    public function createToken(string $email, string $password): string;
}