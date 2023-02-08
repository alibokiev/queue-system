<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReceptionController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['perm:works']);
    }

    public function index()
    {
        $categories = Category::with(['users' => function ($query) {
            $query->where('id', '<>', 1);
        }])->get();

        return response()->json([
            'code' => 200,
            'msg' => 'success',
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $client = Client::firstOrCreate(
            ['phone' => $request->input('phone')]
        );

        $category = Category::findOrFail($request->input('category_id'));

        $user = User::findOrFail($request->input('user_id'));

        $ticket = Ticket::create([
            'category_id' => $category->id,
            'created_at' => Carbon::now(),
            'status_id' => 1,
            'user_id' => $user->id,
            'comment' => '',
            'client_id' => $client->id,
            'number' => Ticket::getNumber($category),
        ]);

        return response()->json([
            'code' => 200,
            'msg' => 'success',
            'ticket' => $ticket,
        ]);
    }

}
