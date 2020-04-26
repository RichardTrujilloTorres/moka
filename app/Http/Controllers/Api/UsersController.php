<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\User;

class UsersController extends BaseController
{
    public function index()
    {
        return new UserCollection(User::paginate($this->perPage()));
    }

    public function store(StoreUserRequest $request)
    {
        /**
         * @var User $user
         */
        $user = User::create($request->only([
            'email',
            'name',
            'password',
        ]));

        return new UserResource($user);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->only(['name', 'password']));

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['data' => []]);
    }
}
