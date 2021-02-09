<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser\Services;

use App\Code\V1\Users\Domain\CreateUser\Interfaces\SaveUserInterface;
use App\Code\V1\Users\Domain\CreateUser\Interfaces\SendEmailInterface;
use App\Models\User;

final class CreateUserService
{
    /**
     * @var SaveUserInterface
     */
    private SaveUserInterface $saveUser;
    /**
     * @var SendEmailInterface
     */
    private SendEmailInterface $sendEmail;

    public function __construct(
        SaveUserInterface $saveUser,
        SendEmailInterface $sendEmail
    ) {
        $this->saveUser = $saveUser;
        $this->sendEmail = $sendEmail;
    }

    public function create(string $name, string $password, string $email): User
    {
        $user = $this->saveUser->save($name, $password, $email);
        $this->sendEmail->send($email);

        return $user;
    }
}