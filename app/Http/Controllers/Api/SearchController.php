<?php

namespace App\Http\Controllers\Api;

use App\Audit;
use App\Console\Commands\GenerateStorageStats;
use App\Exceptions\InvalidHistoryResourceException;
use App\Exceptions\InvalidSearchResourceException;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\AuditCollection;
use App\Http\Resources\StorageStatCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Permission;
use App\Role;
use App\StorageStat;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

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
