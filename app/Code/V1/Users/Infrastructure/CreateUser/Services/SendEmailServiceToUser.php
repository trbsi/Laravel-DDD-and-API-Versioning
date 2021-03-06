<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Infrastructure\CreateUser\Services;

use App\Code\V1\Users\Domain\CreateUser\Services\SendEmailServiceInterface;
use App\Code\V1\Users\Infrastructure\CreateUser\Mailables\WelcomeUserMailable;
use Illuminate\Support\Facades\Mail;

final class SendEmailServiceToUser implements SendEmailServiceInterface
{
    public function send(string $email): void
    {
        Mail::queue(new WelcomeUserMailable($email));
    }
}
