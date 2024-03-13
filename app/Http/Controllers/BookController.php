<?php

namespace App\Http\Controllers;

use App\Events\Book\CreatedBook;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\Photo;
use App\Notifications\Book\CreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Book::class, 'book');
    }

    public function index(Book $book, Request $request)
    {
        if (auth()->user()->hasPermissionTo('book:viewAny')) {
            $query = Book::with('category');
            if ($request->filled('name')) {
                $name = $request->get('name');
                $query->where('name', 'like', "%$name%");
            }
            if ($request->filled('author')) {
                $author = $request->get('author');
                $query->where('author', 'like', "%$author%");
            }
            if ($request->filled('created_at_book')) {
                $query->where('created_at_book', $request->get('created_at_book'));
            }
            if ($request->filled('category')) {
                $query->whereHas('category', function ($query_category) {
                    $query_category->where('name', 'like', '%' . request()->get('category') . '%');
                });
            }
            if ($request->sortBy && in_array($request->sortBy, ['id', 'created_at'])) {
                $sortBy = $request->sortBy;
            } else {
                $sortBy = 'id';
            }
            if ($request->sortOrderBy && in_array($request->sortOrderBy, ['asc', 'desc'])) {
                $sortOrderBy = $request->sortOrderBy;
            } else {
                $sortOrderBy = 'desc';
            }
            $books = $query->OrderBy($sortBy, $sortOrderBy)->get();
            return $this->response(BookResource::collection($books));
        }
    }


    public function store(StoreBookRequest $request)
    {
        if (auth()->user()->hasPermissionTo('book:create')) {

            $book = Book::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'author' => $request->author,
                'created_at_book' => $request->created_at_book,
                'quantity' => $request->quantity
            ]);

            if ($request->file('photo')) {
                $path = $request->file('photo')->store('books/' . $book->id, 'public');

                $book->photo()->create([
                    "full_name" => $request->file('photo')->getClientOriginalName(),
                    "path" => $path
                ]);
            }
            CreatedBook::dispatch($book);
            return $this->success('Book created successfully', $book);
        }
    }


    public function show(Book $book)
    {
        if (auth()->user()->hasPermissionTo('book:view')) {
            return $this->response(new BookResource($book));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {

        if (auth()->user()->hasPermissionTo('book:create'))
            if ($request->book) {
//                $book->id = $request->id;
                $book->category_id = $request->category_id;
                $book->name = $request->name;
                $book->author = $request->author;
                $book->quantity = $request->quantity;
                $book->update();
                return $this->success('Book updated', $book);
            } else {
                return $this->error('Book not found');
            }
    }

    public function destroy(Book $book, Photo $photo)
    {
        Storage::disk('public')->delete("$book->photo->path");

        File::DeleteDirectory('storage/' . 'books/' . "$book->id");

        $book->delete();
        return $this->success('Book deleted');
    }

    public function updatePhoto(Book $book, UpdatePhotoRequest $request)
    {
        if (auth()->user()->hasPermissionTo('book:update')) {

            if ($request->file('photo') !== '' && $request->file('photo') !== null) {
                $directory = $book->photo->path;
                Storage::disk('public')->delete($directory);
                $book->photo()->delete();
            }

            if ($request->file('photo')) {
                $path = $request->file('photo')->store('books/' . $book->id, 'public');
                $book->photo()->create([
                    "path" => $path,
                    "full_name" => $request->file('photo')->getClientOriginalName(),
                ]);
            }
            return $this->success('Book photo updated successfully');
        }
    }
}
