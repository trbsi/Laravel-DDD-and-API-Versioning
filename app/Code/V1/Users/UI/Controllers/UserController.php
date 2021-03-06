<?php

namespace App\Code\V1\Users\UI\Controllers;

use App\Code\V1\Users\Application\Middlemen\CreateUserMiddleman;
use App\Code\V1\Users\Application\Middlemen\GetAllUsersMiddleman;
use App\Code\V1\Users\Application\Middlemen\ReadUserMiddleman;
use App\Code\V1\Users\UI\Requests\CreateUserRequest;
use App\Code\V1\Users\UI\Resources\UserCollection;
use App\Code\V1\Users\UI\Resources\UserResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

final class UserController extends Controller
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

    public function read(int $id, ReadUserMiddleman $readUserMiddleman)
    {
        try {
            $user = $readUserMiddleman->read($id);

            return new UserResource($user);
        } catch (ModelNotFoundException $e) {
            abort(404);
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }

    public function getAllUsers(Request $request, GetAllUsersMiddleman $getAllUsersMiddleman)
    {
        try {
            $users = $getAllUsersMiddleman->mediate();

            return new UserCollection($users);
        } catch (Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {
    }

    public function delete(Request $request)
    {
    }
}
