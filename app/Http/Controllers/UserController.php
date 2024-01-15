<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum');
//        $this->authorizeResource(User::class, 'user');


    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd($user);
        $user = User::all();
        return $this->response($user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        Gate::authorize('user:create');

        $user = User::create($request->toArray());
        return $this->success('user created', new UserResource($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('user:delete');
        $user/*->find($id)*/->delete();
        return $this->success('user deleted');
    }

    public function restore(string $id)
    {
        Gate::authorize('user:restore');

     User::withTrashed()->where('id', $id)->restore();
        return $this->success("id = $id user restored");
    }

    public function forceDelete(string $id)
    {
       if ($id !== null)
       {
           $forceDelete = User::withTrashed()->where('id', $id)->get();
//        dd($forceDelete);
           $forceDelete->forceDelete();
           return $this->success("id = $id user forceDeleted");
       }
    }
}
