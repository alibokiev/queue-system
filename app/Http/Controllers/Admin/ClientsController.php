<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\DestroyClient;
use App\Http\Requests\Admin\Client\IndexClient;
use App\Http\Requests\Admin\Client\StoreClient;
use App\Http\Requests\Admin\Client\UpdateClient;
use App\Models\Client;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ClientsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexClient $request
     * @return Response|array
     */
    public function index(IndexClient $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Client::class)->processRequestAndGet(
        // pass the request with params
        // pass the request with params
            $request,
            // set columns to query
            ['id', 'name', 'surname', 'second_name', 'phone', 'created_at'],
            // set columns to searchIn
            ['id', 'name', 'surname', 'second_name', 'phone', 'created_at']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        //return $data;

        return view('admin.client.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function create()
    {
        //$this->authorize('admin.client.create');

        return view('admin.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClient $request
     * @return Response|array
     */
    public function store(StoreClient $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Client
        $client = Client::create($request->all());

        if ($request->ajax()) {
            return ['redirect' => url('admin/clients/'.$client->id), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param Client $client
     * @return void
     * @throws AuthorizationException
     */
    public function show(Client $client)
    {
        $client = Client::with([
            'tickets.category',
            'tickets.status',
            'tickets.user',
        ])->find($client->id);

        return view('admin.client.show', [
            'client' => $client,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Client $client
     * @return Response
     * @throws AuthorizationException
     */
    public function edit(Client $client)
    {
        //$this->authorize('admin.client.edit', $client);


        return view('admin.client.edit', [
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateClient $request
     * @param Client $client
     * @return Response|array
     */
    public function update(UpdateClient $request, Client $client)
    {


        // Sanitize input
//        $sanitized = $request->getSanitized();
//
//        return $sanitized;
        // Update changed values Client
        $client->update($request->all());

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/clients'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/clients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyClient $request
     * @param Client $client
     * @return Response|bool
     * @throws Exception
     */
    public function destroy(DestroyClient $request, Client $client)
    {
        $client->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyClient $request
     * @return Response|bool
     * @throws Exception
     */
    public function bulkDestroy(DestroyClient $request): Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Client::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
