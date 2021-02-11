<?php
declare(strict_types=1);

namespace App\Code\V1\Auth\UI\Controllers;

use App\Code\V1\Auth\Application\Middlemen\CreateTokenMiddleman;
use App\Code\V1\Auth\Infrastructure\CreateToken\Services\CreateTokenService;
use App\Code\V1\Auth\UI\Requests\CreateTokenRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

final class AuthController
{
    public function createToken(CreateTokenRequest $request, CreateTokenMiddleman $createTokenMiddleman)
    {
        try  {
            $createTokenMiddleman->createToken($request->email, $request->password);
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }
}