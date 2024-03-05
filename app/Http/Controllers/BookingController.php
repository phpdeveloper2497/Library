<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Http\Resources\BookingResource;
use App\Mail\Booking\Confirmed;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Book;
use App\Notifications\Booking\Closed;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class BookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Booking::class, 'booking');
    }


    public function index()
    {
        if (auth()->user()->hasPermissionTo('booking:viewAny')) {
//            $booking = Booking::query()->where('book_id')->get();
            $booking = Booking::all();
            return $this->response(BookingResource::collection($booking));
        }
    }


    public function store(StoreBookingRequest $request)
    {

        dd($request);
        if (auth()->user()->hasPermissionTo('booking:create')) {
            $client_id = $request->get('client_id');
            $status = $request->get('status_id');
            foreach ($request->books as $book) {
               $book_create =  $request->user()->bookings()->create([
                    'book_id' => $book['book_id'],
                    'client_id' => $client_id,
                    'status_id' => $status,
                    'to' => $book['to']
                ]);

                $booking = Book::query()->where('id', '=', $book['book_id'])->decrement('quantity');
            }
            return $this->success('Your booking has been made successfully',new BookingResource($book_create));
        }


    }


    public function show(Booking $booking)
    {
        return $this->response(new BookingResource($booking));
    }

    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
//        dd($booking);
        Book::query()->where('id', '=', $booking['book_id'])->increment('quantity');
        $booking->delete();

        Notification::send($booking->client, new Closed($booking));


        return $this->success('booking deleted');
    }

    public function booksReturnedToday()
    {
        $data_should = Booking::whereDate('to', Carbon::today())->get();
        return $this->response(BookingResource::collection($data_should));
    }
}
