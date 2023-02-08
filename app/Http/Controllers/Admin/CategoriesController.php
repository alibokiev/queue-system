<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\DestroyCategory;
use App\Http\Requests\Admin\Category\IndexCategory;
use App\Http\Requests\Admin\Category\StoreCategory;
use App\Http\Requests\Admin\Category\UpdateCategory;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['perm:categories.crud']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexCategory $request
     * @return Response|array
     */
    public function index(IndexCategory $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Category::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'color'],

            // set columns to searchIn
            ['id', 'name', 'color']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.category.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        //$this->authorize('admin.category.create');

        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategory $request
     * @return Response|array
     */
    public function store(StoreCategory $request)
    {
        // Sanitize input
        $sanitized = $request->validated();

        // Store the Category
        $category = Category::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/categories'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @throws AuthorizationException
     * @return void
     */
    public function show(Category $category)
    {
        //$this->authorize('admin.category.show', $category);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(Category $category)
    {
        //$this->authorize('admin.category.edit', $category);


        return view('admin.category.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategory $request
     * @param Category $category
     * @return Response|array
     */
    public function update(UpdateCategory $request, Category $category)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Category
        $category->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/categories'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCategory $request
     * @param Category $category
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyCategory $request, Category $category)
    {
        $users = User::where('category_id', $category->id)->get();

        foreach ($users as $user) {
            $user->category_id = null;
            $user->save();
        }

        Ticket::where('category_id', $category->id)->delete();

        $category->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param DestroyCategory $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(DestroyCategory $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Category::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
