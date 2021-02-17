<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Domain\CreateUser;

use App\Code\V1\Users\Domain\CreateUser\Services\SaveUserServiceInterface;
use App\Code\V1\Users\Domain\CreateUser\Services\SendEmailServiceInterface;
use App\Code\V1\Users\Domain\CreateUser\Specifications\UserExistsSpecification;
use App\Models\User;
use Exception;

final class CreateUserBusinessLogic
{
    private SaveUserServiceInterface $saveUser;
    private SendEmailServiceInterface $sendEmail;
    private UserExistsSpecification $userExistsSpecification;

    public function __construct(
        SaveUserServiceInterface $saveUser,
        SendEmailServiceInterface $sendEmail,
        UserExistsSpecification $userExistsSpecification
    ) {
        $this->saveUser = $saveUser;
        $this->sendEmail = $sendEmail;
        $this->userExistsSpecification = $userExistsSpecification;
    }

    public function create(string $name, string $password, string $email): User
    {
        if ($this->userExistsSpecification->isSatisfiedBy($email)) {
            throw new Exception(__('v1/users/create_user.user_exists'), 400);
        }

        $user = $this->saveUser->save($name, $password, $email);
        $this->sendEmail->send($email);

        return $user;
    }
}
