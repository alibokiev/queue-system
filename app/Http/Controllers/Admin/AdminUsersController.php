<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminUser\DestroyAdminUser;
use App\Http\Requests\Admin\AdminUser\IndexAdminUser;
use App\Http\Requests\Admin\AdminUser\StoreAdminUser;
use App\Http\Requests\Admin\AdminUser\UpdateAdminUser;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Brackets\AdminAuth\Models\AdminUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Brackets\AdminAuth\Activation\Facades\Activation;
use Brackets\AdminAuth\Services\ActivationService;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class AdminUsersController extends Controller
{

    /**
     * Guard used for admin user
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * AdminUsersController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->guard = config('admin-auth.defaults.guard');

        $this->middleware('perm:users.crud');
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexAdminUser $request
     * @return Response|array
     */
    public function index(IndexAdminUser $request)
    {
        $data = AdminListing::create(User::class)->processRequestAndGet(
            $request,
            // set columns to query
            ['id', 'first_name', 'last_name', 'email', 'activated', 'forbidden', 'category_id', 'language'],
            // set columns to searchIn
            ['id', 'first_name', 'last_name', 'email', 'language'],
            function ($query) use ($request) {
                $query->with(['roles', 'category']);
            }
        );

        if ($request->ajax()) {
            return ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')];
        }

        return view('admin.admin-user.index', ['data' => $data, 'activation' => Config::get('admin-auth.activation_enabled')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Response
     */
    public function create()
    {
        return view('admin.admin-user.create', [
            'activation' => Config::get('admin-auth.activation_enabled'),
            'roles' => Role::where('guard_name', $this->guard)->get(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdminUser $request
     * @return Response|array
     */
    public function store(StoreAdminUser $request)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();

        //return $sanitized;

        // Store the AdminUser
        $adminUser = User::create($sanitized);

        // But we do have a roles, so we need to attach the roles to the adminUser
        $adminUser->roles()->sync(collect($request->input('roles', []))->map->id->toArray());

        if ($request->ajax()) {
            return ['redirect' => url('admin/admin-users'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/admin-users');
    }

    /**
     * Display the specified resource.
     *
     * @param AdminUser $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, User $user)
    {
        Carbon::setWeekStartsAt(Carbon::MONDAY);

        $y = $request->input('y', Carbon::now()->year);
        $m = $request->input('m', Carbon::now()->month);

        $dateStart = Carbon::createFromFormat('Y-m-d', "{$y}-{$m}-01");
        $dateEnd = Carbon::createFromFormat('Y-m-d', "{$y}-{$m}-32");

        $ticketsByDates = Ticket::where('created_at', '>=', $dateStart)
            ->where('created_at', '<=', $dateEnd)
            ->where('user_id', $user->id)
            ->with('category')
            ->groupBy(['date', 'category_id'])
            ->orderBy('date', 'DESC')
            ->get([
                DB::raw('Date(created_at) as date'),
                DB::raw('category_id'),
                DB::raw('COUNT(*) as "tickets"')
            ])->sortBy('date');

        $ticketsByDate = [];
        foreach ($ticketsByDates as $item) {
            $ticketsByDate[$item->date][] = $item;
        }

        $ticketsByCategory = Ticket::where('created_at', '>=', $dateStart)
            ->where('created_at', '<=', $dateEnd)
            ->where('user_id', $user->id)
            ->with('category')
            ->groupBy(['category_id'])
            ->get([
                DB::raw('category_id'),
                DB::raw('COUNT(*) as "tickets"')
            ]);

        $total = Ticket::where('created_at', '>=', $dateStart)->where('user_id', $user->id)
            ->where('created_at', '<=', $dateEnd)->count();

        $totalToday = Ticket::getTodaysByUser($user);

        return view('admin.admin-user.show', [
            'user' => $user,
            'y' => $y,
            'm' => $m,
            'total' => $total,
            'ticketsByCategory' => $ticketsByCategory,
            'ticketsByDate' => $ticketsByDate,
            'totalToday' => $totalToday,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param AdminUser $adminUser
     * @throws AuthorizationException
     * @return Response
     */
    public function edit(User $adminUser)
    {
        //$this->authorize('admin.admin-user.edit', $adminUser);

        $adminUser->load('roles');

        return view('admin.admin-user.edit', [
            'adminUser' => $adminUser,
            'activation' => Config::get('admin-auth.activation_enabled'),
            'roles' => Role::where('guard_name', $this->guard)->get(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAdminUser $request
     * @param AdminUser $adminUser
     * @return Response|array
     */
    public function update(UpdateAdminUser $request, User $adminUser)
    {
        // Sanitize input
        $sanitized = $request->getModifiedData();

        // Update changed values AdminUser
        $adminUser->update($sanitized);

        // But we do have a roles, so we need to attach the roles to the adminUser
        if ($request->input('roles')) {
            $adminUser->roles()->sync(collect($request->input('roles', []))->map->id->toArray());
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/admin-users'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/admin-users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAdminUser $request
     * @param AdminUser $adminUser
     * @throws Exception
     * @return Response|bool
     */
    public function destroy(DestroyAdminUser $request, User $adminUser)
    {
        $adminUser->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

}
