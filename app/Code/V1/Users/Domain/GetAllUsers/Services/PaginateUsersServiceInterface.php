<?php

declare(strict_types=1);

namespace App\Code\V1\Users\Domain\GetAllUsers\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginateUsersServiceInterface
{
    public function getUsers(): LengthAwarePaginator;
}
