<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    /**
     * CabinetController constructor.
     */
    public function __construct()
    {
        $this->middleware(['perm:works']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $today = Carbon::now()->toDateString() . " 00:00:00";

        $category = $user->category()->with(['tickets' => function ($query) use ($today, $user) {
            $query->where('created_at', '>=', Carbon::parse($today))
                ->whereIn('status_id', [1, 2])
                ->with(['status', 'user']);
        }])->first();

        $ticket = $user->tickets()->where('created_at', '>=', Carbon::parse($today))
            ->where('status_id', 2)
            ->first();

        $completedTickets = Ticket::where('created_at', '>=', Carbon::parse($today))
            ->where('status_id', 3)
            ->where('user_id', $user->id)
            ->with(['status'])
            ->orderBy('completed_at', 'desc')
            ->get();

        $data = compact('today', 'user', 'category', 'ticket', 'completedTickets');

        return $data;

    }

    /**
     * @return array
     */
    public function accept()
    {
        $user = Auth::user();
        $today = Carbon::now()->toDateString() . " 00:00:00";

        if ($user->category_id === null) {
            return response()->json([
                'code' => 403,
                'msg' => 'У вас не выбрана категория. Обратитесь к администратору приложения!',
            ]);
        }

        $tickets = $user->category()->with(['tickets' => function ($query) use ($today, $user) {
            $query->where('created_at', '>=', Carbon::parse($today))
                ->where('status_id', 1)
                ->with(['status', 'user']);
        }])->first()->tickets;

        if (count($tickets) == 0) {
            return response()->json([
                'code' => 400,
                'msg' => 'Список пустой',
            ]);
        }

        $currentTicket = $user->tickets()->where('created_at', '>=', Carbon::parse($today))
            ->where('status_id', 2)
            ->first();

        if (!$currentTicket) {
            $currentTicket = $tickets->first();
            $currentTicket->status_id = 2;
            $currentTicket->user_id = $user->id;
            $currentTicket->invited_at = Carbon::now();
            $currentTicket->save();
        }

        return response()->json([
            'code' => 200,
            'msg' => 'success',
            'ticket' => $currentTicket,
        ]);
    }

    /**
     */
    public function done(Request $request)
    {
        $ticket = Ticket::find($request->input('ticketId'));
        $ticket->status_id = 3;
        $ticket->completed_at = Carbon::now();
        $ticket->save();

        return response()->json([
            'code' => 200,
            'msg' => 'success',
        ]);


    }

}