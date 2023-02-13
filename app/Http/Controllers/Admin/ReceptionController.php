<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Ticket;
use Carbon\Carbon;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ReceptionController extends Controller
{
    /**
     * CabinetController constructor.
     */
    public function __construct()
    {
//        $this->middleware(['perm:ticket']);
    }

    public function index()
    {
        $categories = Category::all();

        $text = '';

        return view('admin.reception.index', compact('categories', 'text'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $client = Client::firstOrCreate(['phone' => $request->input('phone')]);

        $category = Category::findOrFail($request->input('category_id'));

        $ticket = Ticket::create([
            'category_id' => $category->id,
            'created_at' => Carbon::now(),
            'status_id' => 1,
            'comment' => '',
            'number' => Ticket::getNumber($category),
        ]);

        return compact('ticket');
    }

    public function skipAll()
    {
        $today = Carbon::now()->toDateString() . " 00:00:00";

        $tickets = Ticket::where('created_at', '>=', Carbon::parse($today))
            ->where('status_id', 1)
            ->get();

        foreach ($tickets as $ticket) {
            $ticket->status_id = 4;
            $ticket->save();
        }
    }


}
