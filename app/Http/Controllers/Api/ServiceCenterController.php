<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServiceCenter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceCenterController extends Controller
{
    public function index(): Response|Application|ResponseFactory
    {
        return $this->response(
            ServiceCenter::query()->get()
        );
    }
}
