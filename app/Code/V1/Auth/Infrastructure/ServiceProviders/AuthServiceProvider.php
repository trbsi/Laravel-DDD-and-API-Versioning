<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\Infrastructure\ServiceProviders;

use App\Code\V1\Auth\Domain\CreateToken\Services\CreateTokenServiceInterface;
use App\Code\V1\Auth\Infrastructure\CreateToken\Services\CreateTokenServiceService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CreateTokenServiceInterface::class, CreateTokenServiceService::class);
    }

    public function boot(): void
    {
    }
}
