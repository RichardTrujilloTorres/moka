<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;

class RolesController extends BaseController
{
    public function index()
    {
        return new RoleCollection(Role::paginate($this->perPage()));
    }

    public function store(StoreRoleRequest $request)
    {
        /**
         * @var Role $role
         */
        $role = Role::create($request->only(['name']));

        return new RoleResource($role);
    }

    public function show(Role $role)
    {
        return new RoleResource($role);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->only(['name',]));

        return new RoleResource($role);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json(['data' => []]);
    }
}
