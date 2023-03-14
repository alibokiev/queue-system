<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CabinetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['perm:works']);
    }

    public function index(Request $request): Application|ResponseFactory|Response
    {
        $user = Auth::user();

        $today = Carbon::now()->toDateString() . " 00:00:00";

        $category = $user->category()->first();

        $tickets = Ticket::with(['status', 'user', 'client'])
            ->where('created_at', '>=', Carbon::parse($today))
            ->whereIn('status_id', [1, 2])
            ->where('user_id', $user->id)
            ->get();

        $ticket = $user->tickets()->where('created_at', '>=', Carbon::parse($today))
            ->where('status_id', 2)
            ->with(['status', 'user', 'client'])
            ->first();

        $completedTickets = Ticket::where('created_at', '>=', Carbon::parse($today))
            ->where('status_id', 3)
            ->where('user_id', $user->id)
            ->with(['status', 'client'])
            ->orderBy('completed_at', 'desc')
            ->get();

        if (is_null($category)) {
            return view('404-admin-page', ['message' => 'Category not found!']);
        }

        $data = compact('today', 'user', 'category', 'ticket', 'tickets', 'completedTickets');

        return $this->response($data);
    }

    public function services(): Response|Application|ResponseFactory
    {
        return $this->response(Service::all());
    }

    public function accept(): Application|ResponseFactory|Response
    {
        $user = Auth::user();
        $today = Carbon::now()->toDateString() . " 00:00:00";

        $ticket = Ticket::with(['status', 'user', 'client'])
            ->where('created_at', '>=', Carbon::parse($today))
            ->whereIn('status_id', [1])
            ->where('service_id', $user->getServicesId())
            ->first();

        if (!is_null($ticket)) {
            $ticket->status_id = 2;
            $ticket->user_id = $user->id;
            $ticket->invited_at = Carbon::now();
            $ticket->save();

            return $this->response($ticket);
        }

        return $this->responseUnsuccess('');
    }

    public function done(Request $request)
    {
        $ticket = Ticket::find($request->input('ticketId'));
        $ticket->status_id = 3;
        $ticket->completed_at = Carbon::now();
        $ticket->save();

    }

    public function saveTicket(Request $request)
    {
        $ticket = Ticket::find($request->input('ticketId'));
        $ticket->status_id = 3;
        $ticket->completed_at = Carbon::now();
        $ticket->service_id = $request->data['service_id'];
        $ticket->comment = $request->data['comment'];
        $ticket->save();

        $client = Client::findOrFail($request->data['id']);
        $client->phone = $request->data['phone'];
        $client->surname = $request->data['surname'];
        $client->name = $request->data['name'];
        $client->second_name = $request->data['second_name'];
        $client->tin = $request->data['tin'];
        $client->passport = $request->data['passport'];
        $client->address = $request->data['address'];
        $client->date_of_birth = $request->data['date_of_birth'];
        $client->save();
    }

}
