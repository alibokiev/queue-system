<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\DestroyService;
use App\Http\Requests\Admin\Service\IndexService;
use App\Http\Requests\Admin\Service\StoreService;
use App\Http\Requests\Admin\Service\UpdateService;
use App\Models\Service;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    public function index(IndexService $request): Response|Application|ResponseFactory
    {
        $search = $request->input('search');

        $services = Service::query();

        if ($search) {
            $services->where('name', 'like', "%$search")
                ->orWhere('code', 'like', "%$search");
        }

        return $this->response($services->get());
    }

    public function store(StoreService $request): Response|Application|ResponseFactory
    {
        $service = Service::query()->firstOrCreate($request->all());

        if ($request->input('category_id')) {
            $service->category()->associate($request->input('category_id'));
        }

        return $this->response($service);
    }

    public function update(UpdateService $request, Service $service): Response|Application|ResponseFactory
    {
        $service->update($request->all());

        if ($request->input('category_id')) {
            $service->category()->associate($request->input('category_id'));
        }
        return $this->response($service);
    }

    public function destroy(DestroyService $request, Service $service): Response|Application|ResponseFactory
    {
        $service->delete();

        return $this->response();
    }
}
