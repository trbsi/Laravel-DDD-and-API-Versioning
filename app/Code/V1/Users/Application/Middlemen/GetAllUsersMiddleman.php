<?php

declare(strict_types=1);

namespace App\Code\V1\Users\Application\Middlemen;

use App\Code\V1\Users\Domain\GetAllUsers\GetAllUsersBusinessLogic;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetAllUsersMiddleman
{
    private GetAllUsersBusinessLogic $getAllUsersBusinessLogic;

    public function __construct(GetAllUsersBusinessLogic $getAllUsersBusinessLogic)
    {
        $this->getAllUsersBusinessLogic = $getAllUsersBusinessLogic;
    }

    public function mediate(): LengthAwarePaginator
    {
        return $this->getAllUsersBusinessLogic->logic();
    }
}
