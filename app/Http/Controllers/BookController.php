<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth:sanctum');
        $this->authorizeResource(Book::class, 'book');
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('book:viewAny'))
        {
        return $this->response(BookResource::collection(Book::all()));
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        if($request->user()->hasPermissionTo('book:create'))
        {
        $book = Book::create([
            'category_id' => $request->category_id,
            'name' =>$request->name,
            'author' =>$request->author,
            'quantity' =>$request->quantity
        ]);
        }
        return $this->success('Book created successfully', $book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return $this->response(new BookResource($book));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

    }
}
