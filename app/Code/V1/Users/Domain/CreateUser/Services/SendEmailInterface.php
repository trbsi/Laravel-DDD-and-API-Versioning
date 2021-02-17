<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser\Services;

interface SendEmailInterface
{
    public function send(string $email): void;
}