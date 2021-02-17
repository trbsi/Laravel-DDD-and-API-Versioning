<?php

namespace App\Code\V1\Users\Infrastructure\ServiceProviders;

use App\Code\V1\Users\Domain\CreateUser\Services\SaveUserInterface;
use App\Code\V1\Users\Domain\CreateUser\Services\SendEmailInterface;
use App\Code\V1\Users\Infrastructure\CreateUser\Services\SaveUserToDatabase;
use App\Code\V1\Users\Infrastructure\CreateUser\Services\SendEmailToUser;
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
        $this->app->bind(SaveUserInterface::class, SaveUserToDatabase::class);
        $this->app->bind(SendEmailInterface::class, SendEmailToUser::class);
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
