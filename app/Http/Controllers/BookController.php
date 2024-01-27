<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePhotoBookRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Photo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Book::class, 'book');
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('book:viewAny')) {
            return $this->response(BookResource::collection(Book::all()));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        if (auth()->user()->hasPermissionTo('book:create')) {
            $book = Book::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'author' => $request->author,
                'quantity' => $request->quantity
            ]);

            if ($request->file('photo')) {
                $path = $request->file('photo')->store('books/' . $book->id, 'public');

                $book->photo()->create([
                    "full_name" => $request->file('photo')->getClientOriginalName(),
                    "path" => $path
                ]);
            }
            return $this->success('Book created successfully', $book);
        }
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
//            $book->users()->id = $request->id;
//            $book->category_id =  $request->category_id;
//            $book->name = $request->name;
//            $book->author = $request->author;
//            $book->quantity = $request->quantity;
//            $book->save();
//            return $this->success('Book updated' , $book);
//dd($request->all());
//        $book = Book::findOrFail($request->id);
//        $book->update($request->all());
//        return $this->success('Book updated', $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, Photo $photo)
    {
        Storage::disk('public')->delete("$book->photo->path");

        File::DeleteDirectory('storage/'.'books/'."$book->id");

        $book->delete();
        return $this->success('Book deleted');
    }

//    public function UpdatePhoto(Book $book, UpdatePhotoBookRequest $request)
//    {
////        dd('ok');
//        if (auth()->user()->hasPermissionTo('book:update'))
//        {
//            if($request->file('photo') !== '' && $request->file('photo') !== null)
//            {
//                Storage::disk('public')->delete("$book->photo->path");
//            }
//
//            if($request->file('photo'))
//            {
//                $path = $request->file('photo')->store('books/'.$book->id, 'public');
//            $book->photo->create([
//                "path" => $path,
//                "full_name" => $request->file('photo')->getClientOriginalName(),
//            ]);
//            }
//            return $this->success('Book photo updated successfully');
//        }
//    }
}
