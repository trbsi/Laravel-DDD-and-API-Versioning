<?php

namespace App\Code\V1\Users\Infrastructure\ServiceProviders;

use App\Code\V1\Users\Domain\CreateUser\Services\GetUserServiceInterface;
use App\Code\V1\Users\Domain\CreateUser\Services\SaveUserServiceInterface;
use App\Code\V1\Users\Domain\CreateUser\Services\SendEmailServiceInterface;
use App\Code\V1\Users\Domain\GetAllUsers\Services\PaginateUsersServiceInterface;
use App\Code\V1\Users\Domain\ReadUser\Services\ReadUserServiceInterface;
use App\Code\V1\Users\Infrastructure\CreateUser\Services\GetUserFromDatabaseService;
use App\Code\V1\Users\Infrastructure\CreateUser\Services\SaveUserServiceToDatabase;
use App\Code\V1\Users\Infrastructure\CreateUser\Services\SendEmailServiceToUser;
use App\Code\V1\Users\Infrastructure\GetAllUsers\Services\GetUsersFromDatabase;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->createUser();
        $this->readUser();
        $this->getAllUsers();
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }

    private function createUser(): void
    {
        $this->app->bind(SaveUserServiceInterface::class, SaveUserServiceToDatabase::class);
        $this->app->bind(SendEmailServiceInterface::class, SendEmailServiceToUser::class);
        $this->app->bind(GetUserServiceInterface::class, GetUserFromDatabaseService::class);
    }

    private function readUser(): void
    {
        $this->app->bind(ReadUserServiceInterface::class, GetUserFromDatabaseService::class);
    }

    private function getAllUsers(): void
    {
        $this->app->bind(PaginateUsersServiceInterface::class, GetUsersFromDatabase::class);
    }
}
