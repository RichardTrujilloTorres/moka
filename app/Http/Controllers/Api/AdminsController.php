<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\User;

class AdminsController extends BaseController
{
    const ADMIN_ROLE_NAME = 'admin';

    public function index()
    {
        return new UserCollection(User::admin()->paginate($this->perPage()));
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

        $user->assignRole(self::ADMIN_ROLE_NAME);

        return new UserResource($user);
    }

    public function show(int $id)
    {
        /**
         * @var User $user
         */
        $user = $this->getAdmin($id);

        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        /**
         * @var User $user
         */
        $user = $this->getAdmin($id);

        $user->update($request->only(['name', 'password']));

        return new UserResource($user);
    }

    public function destroy(int $id)
    {
        /**
         * @var User $user
         */
        $user = $this->getAdmin($id);

        $user->removeRole(self::ADMIN_ROLE_NAME);

        return response()->json(['data' => []]);
    }

    protected function getAdmin(int $userId)
    {
        return User::admin()->findOrFail($userId);
    }
}
