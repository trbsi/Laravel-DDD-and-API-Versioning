<?php
declare(strict_types=1);

namespace App\Code\V1\Auth\UI\Controllers;

use App\Code\V1\Auth\Application\Middlemen\CreateTokenMiddleman;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;

final class AuthController
{
    public function createToken(Request $request, CreateTokenMiddleman $createTokenMiddleman)
    {
        try  {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $createTokenMiddleman->createToken($request->email, $request->password);
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }
}