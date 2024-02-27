<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Requests\UpdateStatusRequest;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Status::class, 'status');
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('status:viewAny')) {
//            return $this->response($this->status);
            return 'View statuses';
        }
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
    public function store(StoreStatusRequest $request)
    {
        if (auth()->user()->hasPermissionTo('status:create')) {

            $status = Status::create([
                'name' => $request->name,
                'for' =>$request->for,
                'code' =>$request->code
                ]);
        }
        return $this->success('Status created', $status);
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        if (auth()->user()->hasPermissionTo('status:delete')) {
            $status->delete();
            return $this->success('Status deleted');
        }
    }
}
