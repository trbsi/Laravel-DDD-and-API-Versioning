<?php

namespace App\Code\V1\Users\UI\Controllers;

use App\Code\V1\Users\Application\Services\CreateUserMiddleman;
use App\Code\V1\Users\UI\Requests\CreateUserRequest;
use App\Code\V1\Users\UI\Requests\UserResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

final class UsersController extends Controller
{
    public function create(CreateUserRequest $request, CreateUserMiddleman $createUserMiddleman)
    {
        try {
            $user = $createUserMiddleman->create($request->name, $request->password, $request->email);
            return new UserResource($user);
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }

    public function read(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}