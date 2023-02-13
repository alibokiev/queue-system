<?php

namespace App\Http\Controllers\Monitor;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $grad = "0", $size = 14)
    {
        $today = Carbon::now()->toDateString() . " 00:00:00";

        $categories = Category::with(['tickets' => function ($query) use ($today) {
            $query->where('created_at', '>=', Carbon::parse($today))
                ->whereIn('status_id', [1, 2])
                ->with(['status', 'user']);
        }, 'users'])->get();

        $users = User::select('users.*')->join('categories', 'users.category_id', '=', 'categories.id')
            ->with(['tickets' => function ($query) use ($today) {
                $query->where('created_at', '>=', Carbon::parse($today))
                    ->whereIn('status_id', [1, 2])
                    ->with(['status']);
            }, 'category'])
//            ->where('users.id', '<>', 1)
            ->get();

        if ($request->ajax()) {
            return compact('categories', 'users');
        }

        if ($size == '') $size = 14;
        if ($size < 5) $size = 5;
        if ($size > 44) $size = 44;

        if ($grad != "90" && $grad != "-90") $grad = "";

        return view("monitor.index{$grad}", compact('categories', 'users', 'size'));

    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index90(Request $request)
    {
        $today = Carbon::now()->toDateString() . " 00:00:00";

        $categories = Category::with(['tickets' => function ($query) use ($today) {
            $query->where('created_at', '>=', Carbon::parse($today))
                ->whereIn('status_id', [1, 2])
                ->with(['status', 'user']);
        }, 'users'])->get();

        $users = User::select('users.*')->join('categories', 'users.category_id', '=', 'categories.id')
            ->with(['tickets' => function ($query) use ($today) {
                $query->where('created_at', '>=', Carbon::parse($today))
                    ->whereIn('status_id', [1, 2])
                    ->with(['status']);
            }, 'category'])
            ->where('users.id', '<>', 1)
            ->get();

        if ($request->ajax()) {
            return compact('categories', 'users');
        }

        return view('monitor.index90', compact('categories', 'users'));
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexMinus90(Request $request)
    {
        $today = Carbon::now()->toDateString() . " 00:00:00";

        $categories = Category::with(['tickets' => function ($query) use ($today) {
            $query->where('created_at', '>=', Carbon::parse($today))
                ->whereIn('status_id', [1, 2])
                ->with(['status', 'user']);
        }, 'users'])->get();

        $users = User::select('users.*')->join('categories', 'users.category_id', '=', 'categories.id')
            ->with(['tickets' => function ($query) use ($today) {
                $query->where('created_at', '>=', Carbon::parse($today))
                    ->whereIn('status_id', [1, 2])
                    ->with(['status']);
            }, 'category'])
            ->where('users.id', '<>', 1)
            ->get();

        if ($request->ajax()) {
            return compact('categories', 'users');
        }

        return view('monitor.index-90', compact('categories', 'users'));
    }

}
