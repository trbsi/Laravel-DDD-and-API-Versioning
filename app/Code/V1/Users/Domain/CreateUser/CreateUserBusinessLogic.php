<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser;

use App\Code\V1\Users\Domain\CreateUser\Services\SaveUserServiceInterface;
use App\Code\V1\Users\Domain\CreateUser\Services\SendEmailServiceInterface;
use App\Models\User;

final class CreateUserBusinessLogic
{
    /**
     * @var SaveUserServiceInterface
     */
    private SaveUserServiceInterface $saveUser;
    /**
     * @var SendEmailServiceInterface
     */
    private SendEmailServiceInterface $sendEmail;

    public function __construct(
        SaveUserServiceInterface $saveUser,
        SendEmailServiceInterface $sendEmail
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