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
        $data = Service::query()->get();

        return $this->response($data);
    }

    public function store(StoreService $request): Response|Application|ResponseFactory
    {
        $service = Service::query()->create($request->all());

        return $this->response($service);
    }

    public function update(UpdateService $request, Service $service): Response|Application|ResponseFactory
    {
        $service->update($request->all());

        return $this->response($service);
    }

    public function destroy(DestroyService $request, Service $service): Response|Application|ResponseFactory
    {
        $service->delete();

        return $this->response();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyService $request
     * @return Response
     */
    public function bulkDestroy(DestroyService $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Service::query()->whereIn('id', $bulkChunk)->delete();
                });
        });

        return $this->response();
    }
}
