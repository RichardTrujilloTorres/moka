<?php

namespace App\Http\Controllers\Api;

use App\Audit;
use App\Console\Commands\GenerateStorageStats;
use App\Exceptions\InvalidHistoryResourceException;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\AuditCollection;
use App\Http\Resources\StorageStatCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\StorageStat;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class StorageStatsController extends BaseController
{
    public function index()
    {
        return new StorageStatCollection(StorageStat::paginate($this->perPage()));
    }

    public function regenerate()
    {
        $output = Artisan::call('moka:storage-stats:generate');

        return response()->json([
            'status' => $output !== 0 ? 'failure' : 'success',
            'message' => $output !== 0 ? 'Stats generation failed' : 'Stats generation completed.',
        ], $output !== 0 ? 400 : 201);
    }
}
