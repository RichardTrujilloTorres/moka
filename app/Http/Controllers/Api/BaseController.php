<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    const DEFAULT_PER_PAGE = 20;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function perPage()
    {
        return $this->request->has('per_page') ?
            $this->request->get('per_page') :
            self::DEFAULT_PER_PAGE;
    }
}
