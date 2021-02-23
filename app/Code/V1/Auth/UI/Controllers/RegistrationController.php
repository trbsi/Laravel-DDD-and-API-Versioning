<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\UI\Controllers;

use App\Code\V1\Auth\Application\Middlemen\RegistrationMiddleman;
use App\Code\V1\Auth\UI\Requests\RegistrationRequest;
use App\Http\Controllers\Controller;
use Exception;

final class RegistrationController extends Controller
{
    public function registration(RegistrationRequest $request, RegistrationMiddleman $registrationMiddleman)
    {
        try {
            //$registrationMiddleman->mediate();
        } catch (Exception $e) {
        }
    }
}
