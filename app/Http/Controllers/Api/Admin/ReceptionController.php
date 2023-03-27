<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Client;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReceptionController extends Controller
{
    /**
     * CabinetController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Response|Application|ResponseFactory
     */
    public function index(): Response|Application|ResponseFactory
    {
        $serviceCategories = ServiceCategory::with('services')->get();

        $text = '';

        return $this->response(compact('serviceCategories', 'text'));
    }

    /**
     * @param Request $request
     * @return Application|Response|ResponseFactory
     */
    public function store(Request $request): Application|ResponseFactory|Response
    {
        Client::query()->firstOrCreate(['phone' => $request->input('phone')]);

        $service = Service::findOrFail($request->input('serviceId'));

        $ticket = Ticket::create([
            'service_id' => $service->id,
            'created_at' => Carbon::now(),
            'status_id' => 1,
            'comment' => '',
            'number' => Ticket::getNumber($service),
        ]);

        return $this->response($ticket);
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
