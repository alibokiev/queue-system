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
    public function index(Request $request): Response|Application|ResponseFactory
    {
        $search = $request->input('search');

        $serviceCenters = ServiceCenter::query();

        if ($search) {
            $serviceCenters->where('name', 'like', "%$search");
        }

        return $this->responsePaginate($serviceCenters->paginate());
    }

    public function store(Request $request): Response|Application|ResponseFactory
    {
        return $this->response(ServiceCenter::query()->create($request->all()));
    }

    public function update(Request $request, ServiceCenter $serviceCenter): Response|Application|ResponseFactory
    {
        $serviceCenter->update($request->all());

        return $this->response($serviceCenter);
    }

    public function destroy(ServiceCenter $serviceCenter): Response|Application|ResponseFactory
    {
        $serviceCenter->delete();

        return $this->response($serviceCenter);
    }

    public function list(): Response|Application|ResponseFactory
    {
        return $this->response(
            ServiceCenter::query()->get()
        );
    }
}
