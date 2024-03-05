<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum');


    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd($user);

        $user = User::all();
        return $this->response(UserResource::collection($user));
    }


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
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->update();

            return $this->success('user updated', $user);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('user:delete');
        $directory = $user?->photo?->path;
        if($directory){
            Storage::disk('public')->delete($directory);
            File::deleteDirectory(public_path('storage/' . 'users/' . "$user->id"));
            $user->delete();    
        }else{
            $user->delete();
        }

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
        if ($id !== null) {
            $forceDelete = User::withTrashed()->where('id', $id)->first();
            $forceDelete->forceDelete();
            return $this->success("id = $id user forceDeleted");
        }
    }

    public function updatePhoto(User $user, UpdatePhotoRequest $request)
    {
//        Gate::authorize('user:update');
        Gate::authorize('user:update');


        if ($user->photo->path != '' || $user->photo->path != null) {
            $directory = $user->photo->path;
            Storage::disk('public')->delete($directory);
            $user->photo()->delete();
            //TODO:  check
        }

        if ($request->file('photo')) {
            $path = $request->file('photo')->store("users/" . $user->id, 'public');
            $user->photo()->create([
                "full_name" => $request->file('photo')->getClientOriginalName(),
                "path" => $path
            ]);

            return $this->success('photo updated successfully');
        }


    }
}
