<?php

namespace App\Http\Controllers\Api;

use App\Permission;
use App\Role;
use App\User;

class SearchController extends BaseController
{
    public function query()
    {
        $query = $this->request->query->get('query', '');
        if (empty($query)) {
            return response()->json([
                'message' => 'No query specified.',
            ], 422);
        }

        return collect(User::search($query)->get())
            ->concat(Role::search($query)->get())
            ->concat(Permission::search($query)->get())
            ;
    }
}
