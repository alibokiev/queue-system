<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\Client;
use App\Models\Service;
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
        $categories = ServiceCategory::with(['users' => function ($query) {
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
        $request->validate([
            'phone' => 'required',
            'service_id' => 'required',
            'user_id' => 'required'
        ]);

        $client = Client::query()->firstOrCreate(
            ['phone' => $request->input('phone')]
        );

        $service = Service::query()->findOrFail($request->input('service_id'));

        $user = User::query()->findOrFail($request->input('user_id'));

        $ticket = Ticket::query()->create([
            'service_id' => $service->id,
            'created_at' => Carbon::now(),
            'status_id' => 1,
            'user_id' => $user->id,
            'comment' => '',
            'client_id' => $client->id,
            'number' => Ticket::getNumber($service),
            'category_id' => 1,
        ]);

        return response()->json([
            'code' => 200,
            'msg' => 'success',
            'ticket' => $ticket,
        ]);
    }

}
