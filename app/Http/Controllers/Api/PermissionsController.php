<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Resources\PermissionCollection;
use App\Http\Resources\PermissionResource;
use App\Permission;

class PermissionsController extends BaseController
{
    public function index()
    {
        return new PermissionCollection(Permission::paginate($this->perPage()));
    }

    public function store(StorePermissionRequest $request)
    {
        /**
         * @var Permission $permission
         */
        $permission = Permission::create($request->only(['name']));

        return new PermissionResource($permission);
    }

    public function show(Permission $permission)
    {
        return new PermissionResource($permission);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->only(['name',]));

        return new PermissionResource($permission);
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json(['data' => []]);
    }
}
