<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Resources\ShowTeamTesource;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function index()
    {
        $teams = Team::all();
        $teams = request('name');
        $teams = Team::where('name','like','%'.$teams.'%')->get();
        $teams = TeamResource::collection($teams);
        return response()->json(['success' =>true, 'data' =>$teams],200);
    }

    public function store(StoreTeamRequest $request)
    {
        $team = Team::store($request);
        return response()->json(['success' =>true, 'data' =>$team],201);
    }

    public function show(string $id)
    {
       
        $team = Team::find($id);
        $team = new ShowTeamTesource($team);
        return response()->json(['success' =>true , 'data' =>$team],201);
    }
  

    public function update(StoreTeamRequest $request, string $id)
    {
        $team = Team::store($request,$id);
        return response()->json(['success'=>true, 'data'=>$team],201);
    }

    public function destroy(string $id)
    {
        $team = Team::find($id);
        $team->delete();

        return response()->json(['success' => true, 'data'=>'already_deleted'],201);
    }
}
