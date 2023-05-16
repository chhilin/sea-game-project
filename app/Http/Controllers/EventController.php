<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\StorEventRequest;
use App\Http\Resources\EventResource;
use App\Http\Resources\ShowEventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();
        $events = request('sportName');
        $events = Event::where('sportName','like','%'.$events.'%')->get();
        $events = EventResource::collection($events);
        return response()->json(['success' =>true, 'data' => $events], 200);
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::store($request);
        return response()->json(['success' =>true, 'data' => $event], 201);
    }

    public function show(string $id)
    {
        $event = Event::find($id);
        $event = new ShowEventResource($event);
        return response()->json(['success' =>true, 'data' => $event], 201);
    }

    public function update(StoreEventRequest $request, string $id)
    {
        $event = Event::store($request, $id);
        return response()->json(['success' =>true, 'data' => $event], 201);
    }

    public function destroy(string $id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(['success' =>true, 'data' => 'user already deleted']);
    }
}
