<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\DestroyService;
use App\Http\Requests\Admin\Service\IndexService;
use App\Http\Requests\Admin\Service\StoreService;
use App\Http\Requests\Admin\Service\UpdateService;
use App\Models\Service;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexService $request
     * @return Response|array
     */
    public function index(IndexService $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Service::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'boj', 'hizmat', 'kogaz'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.service.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        //$this->authorize('admin.service.create');

        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreService $request
     * @return Response|array
     */
    public function store(StoreService $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Service
        $service = Service::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/services'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/services');
    }

    /**
     * Display the specified resource.
     *
     * @param Service $service
     * @throws AuthorizationException
     * @return void
     */
    public function show(Service $service)
    {
        //$this->authorize('admin.service.show', $service);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(Service $service)
    {
        //$this->authorize('admin.service.edit', $service);


        return view('admin.service.edit', [
            'service' => $service,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateService $request
     * @param Service $service
     * @return Response|array
     */
    public function update(UpdateService $request, Service $service)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Service
        $service->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/services'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyService $request
     * @param Service $service
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyService $request, Service $service)
    {
        $service->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyService $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyService $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Service::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
