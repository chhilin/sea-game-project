<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\ShowUserResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        $user = request('name');
        $user = User::where('name','like','%'.$user.'%')->get();
        $users = UserResource::collection($user);
        return response()->json(['successfull' => true, 'data' => $users],200);
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make($request->password),
        ]);
        return response()->json(['successfull' => true, 'data' => $user], 201);
    }

    public function show(string $id)
    {
        $user = User::find($id);
        if($user){
            $user = new ShowUserResource($user);
            return response()->json(['successfull' => true, 'data' => $user], 200);
        }else{
            return response()->json(['data' => 'user not found']);
        }
    }

    public function update(StoreUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['successfull' => true, 'data' => $user], 201);
    }
    
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['successfull' => true, 'data' => 'user already removed'], 200);
    }
}
