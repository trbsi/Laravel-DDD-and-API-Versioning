<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Infrastructure\ServiceProviders;

use App\Code\V1\Auth\Domain\CreateToken\Services\CreateTokenServiceInterface;
use App\Code\V1\Auth\Domain\Registration\Services\GetUserServiceInterface;
use App\Code\V1\Auth\Domain\Registration\Services\SaveUserInterface;
use App\Code\V1\Auth\Infrastructure\CreateToken\Services\CreateTokenServiceService;
use App\Code\V1\Auth\Infrastructure\Registration\Services\GetUserFromDatabaseService;
use App\Code\V1\Auth\Infrastructure\Registration\Services\SaveUserToTheDatabase;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->createToken();
        $this->registration();
    }

    public function boot(): void
    {
    }

    private function registration(): void
    {
        $this->app->bind(GetUserServiceInterface::class, GetUserFromDatabaseService::class);
        $this->app->bind(SaveUserInterface::class, SaveUserToTheDatabase::class);
    }

    private function createToken(): void
    {
        $this->app->bind(CreateTokenServiceInterface::class, CreateTokenServiceService::class);
    }
}
