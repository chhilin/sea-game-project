<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketResource;
use App\Http\Resources\ShowTicketResource;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index()
    {
        $tickets = Ticket::all();
        $ticket = TicketResource::collection($tickets);
        return response()->json(['success' =>true, 'data' => $ticket],200);
    }

    public function store(StoreTicketResource $request)
    {
        $ticket = Ticket::store($request);
        return response()->json(['success' =>true, 'data' => $ticket],201);
    }

    public function show(string $id)
    {
        $ticket = Ticket::find($id);
        $ticket = new ShowTicketResource($ticket);
        return response()->json(['success' =>true, 'data' => $ticket],200);
    }

    public function update(StoreTicketResource $request, string $id)
    {
        $ticket = Ticket::store($request, $id);
        return response()->json(['success' =>true, 'data' => $ticket],200);
    }

    public function destroy(string $id)
    {
        //
    }
}
