<?php

namespace App\Http\Controllers\Api;

use App\Audit;
use App\Exceptions\InvalidHistoryResourceException;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\AuditCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\User;

class HistoriesController extends BaseController
{

    public function index(string $resource)
    {
        return $this->getModel($resource);
    }

    protected function getModel(string $resource)
    {
        switch ($resource) {
            case 'user':
                return new AuditCollection(Audit::user()->paginate($this->perPage()));
                break;

            case 'role':
                return new AuditCollection(Audit::role()->paginate($this->perPage()));
                break;

            case 'permission':
                return new AuditCollection(Audit::permission()->paginate($this->perPage()));
                break;

            default:
                throw new InvalidHistoryResourceException;
        }
    }
}
