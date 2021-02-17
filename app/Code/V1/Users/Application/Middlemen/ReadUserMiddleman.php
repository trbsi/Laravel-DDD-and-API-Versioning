<?php
declare(strict_types=1);

namespace App\Code\V1\Users\Application\Middlemen;

use App\Code\V1\Users\Domain\ReadUser\ReadUserBusinessLogic;
use App\Models\User;

final class ReadUserMiddleman
{
    private ReadUserBusinessLogic $readUserBusinessLogic;

    public function __construct(ReadUserBusinessLogic $readUserBusinessLogic)
    {
        $this->readUserBusinessLogic = $readUserBusinessLogic;
    }

    public function read(int $id): User
    {
        return $this->readUserBusinessLogic->read($id);
    }
}
