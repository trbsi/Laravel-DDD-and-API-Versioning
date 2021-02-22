<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\UI\Controllers;

use App\Code\V1\Auth\Application\Middlemen\RegisterMiddleman;
use App\Code\V1\Auth\UI\Requests\RegistrationRequest;
use App\Http\Controllers\Controller;
use Exception;

final class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request, RegisterMiddleman $registerMiddleman)
    {
        try {
        } catch (Exception $e) {
        }
    }
}
