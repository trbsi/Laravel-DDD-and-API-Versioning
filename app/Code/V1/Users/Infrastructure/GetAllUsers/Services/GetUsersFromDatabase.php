<?php

declare(strict_types=1);

namespace App\Code\V1\Users\Infrastructure\GetAllUsers\Services;

use App\Code\V1\Users\Domain\GetAllUsers\Services\PaginateUsersServiceInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetUsersFromDatabase implements PaginateUsersServiceInterface
{
    public function getUsers(): LengthAwarePaginator
    {
        return User::paginate(2);
    }
}
