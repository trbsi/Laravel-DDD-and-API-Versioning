<?php

declare(strict_types=1);

namespace App\Code\V1\Users\Domain\GetAllUsers;

use App\Code\V1\Users\Domain\GetAllUsers\Services\PaginateUsersServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetAllUsersBusinessLogic
{
    private PaginateUsersServiceInterface $paginateUsersService;

    public function __construct(
        PaginateUsersServiceInterface $paginateUsersService
    ) {
        $this->paginateUsersService = $paginateUsersService;
    }

    public function logic(): LengthAwarePaginator
    {
        return $this->paginateUsersService->getUsers();
    }
}
