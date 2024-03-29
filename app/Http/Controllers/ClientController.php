<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Resources\BookBokingResource;
use App\Http\Resources\ClientBookingResource;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Notifications\Client\RegisteredClient;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Client::class, 'client');
    }


    public function index()
    {
        $client = Client::query()->paginate(30);
        return $this->response(ClientResource::collection($client));
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
    public function store(StoreClientRequest $request)
    {
        if (auth()->user()->hasPermissionTo('client:create'))
        {
        $client = Client::create($request->all());
        if ($request->file('photo')) {
            $path = $request->file('photo')->store("clients/" . $client->id, "public");
            $client->photo()->create([
                "full_name" => $request->file('photo')->getClientOriginalName(),
                "path" => $path,
            ]);
//            Notification::send($client, new RegisteredClient($client));
            return $this->success('Client created', $client);
        }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        if (auth()->user()->hasPermissionTo('client:view')) {
            return $this->response(new ClientBookingResource($client));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        if (auth()->user()->hasPermissionTo('client:delete')) {

            $directory = $client->photo->path;
            Storage::disk('public')->delete($directory);

            File::deleteDirectory(public_path('storage/' . 'clients/' . "$client->id"));

            $client->delete();

            return $this->success('Client deleted successfully');
        }
    }

    public function updatePhoto(Client $client, UpdatePhotoRequest $request)
    {
        if (auth()->user()->hasPermissionTo('client:update')) {

//            dd($client->photo->path);
            if ($client->photo->path != '' && $client->photo->path != null) {
                $directory = $client->photo->path;
                Storage::disk('public')->delete($directory);
            }

            if ($request->file('photo')) {
                $path = $request->file('photo')->store("clients/" . $client->id, 'public');
                $client->photo()->create([
                    "full_name" => $request->file('photo')->getClientOriginalName(),
                    "path" => $path
                ]);

                return $this->success('photo updated successfully');
            }
        }
    }



}
