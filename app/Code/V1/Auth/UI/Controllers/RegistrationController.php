<?php

declare(strict_types=1);

namespace App\Code\V1\Auth\UI\Controllers;

use App\Code\V1\Auth\Application\Middlemen\RegistrationMiddleman;
use App\Code\V1\Auth\UI\Requests\RegistrationRequest;
use App\Code\V1\Auth\UI\Resources\UserResource;
use App\Http\Controllers\Controller;
use Exception;

final class RegistrationController extends Controller
{
    public function registration(RegistrationRequest $request, RegistrationMiddleman $registrationMiddleman)
    {
        try {
            $user = $registrationMiddleman->mediate($request->email, $request->name, $request->password);

            return new UserResource($user);
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }
}
