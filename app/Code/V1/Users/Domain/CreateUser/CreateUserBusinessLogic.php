<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser;

use App\Code\V1\Users\Domain\CreateUser\Services\SaveUserInterface;
use App\Code\V1\Users\Domain\CreateUser\Services\SendEmailInterface;
use App\Models\User;

final class CreateUserBusinessLogic
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