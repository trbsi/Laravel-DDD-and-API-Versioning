<?php

namespace App\Code\V1\Users\Infrastructure\ServiceProviders;

use App\Code\V1\Users\Domain\CreateUser\Services\SaveUserServiceInterface;
use App\Code\V1\Users\Domain\CreateUser\Services\SendEmailServiceInterface;
use App\Code\V1\Users\Domain\ReadUser\Services\ReadUserServiceInterface;
use App\Code\V1\Users\Infrastructure\CreateUser\Services\SaveUserServiceToDatabase;
use App\Code\V1\Users\Infrastructure\CreateUser\Services\SendEmailServiceToUser;
use App\Code\V1\Users\Infrastructure\ReadUser\Services\ReadUserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SaveUserServiceInterface::class, SaveUserServiceToDatabase::class);
        $this->app->bind(SendEmailServiceInterface::class, SendEmailServiceToUser::class);
        $this->app->bind(ReadUserServiceInterface::class, ReadUserService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
