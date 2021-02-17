<?php
declare(strict_types=1);

namespace App\Code\V1\Auth\Infrastructure\ServiceProviders;

use App\Code\V1\Auth\Domain\CreateToken\Interfaces\CreateTokenInterface;
use App\Code\V1\Auth\Infrastructure\CreateToken\Services\CreateTokenService;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CreateTokenInterface::class, CreateTokenService::class);
    }

    public function boot(): void
    {
    }
}
