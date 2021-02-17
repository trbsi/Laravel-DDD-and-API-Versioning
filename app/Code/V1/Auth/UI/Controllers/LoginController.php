<?php
declare(strict_types=1);

namespace App\Code\V1\Auth\UI\Controllers;

use App\Code\V1\Auth\Application\Middlemen\CreateTokenMiddleman;
use App\Code\V1\Auth\UI\Requests\CreateTokenRequest;
use Exception;
use App\Http\Controllers\Controller;

final class LoginController extends Controller
{
    public function createToken(CreateTokenRequest $request, CreateTokenMiddleman $createTokenMiddleman)
    {
        try  {
            $token = $createTokenMiddleman->createToken($request->email, $request->password);
            return response()->json([
                'token' => $token
            ]);
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }
}