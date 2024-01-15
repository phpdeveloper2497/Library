<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Book;
use Carbon\Carbon;

class BookingController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth:sanctum');
//         $this->authorizeResource(Booking::class, 'booking');
    }


    public function index()
    {
//        if(auth()->user()->hasPermissionTo('booking:viewAny'))
//        {
        return $this->response(BookingResource::collection(Booking::all()));
//        }
//        return 'ok';
    }


    public function store(StoreBookingRequest $request)
    {

//        $startDate = Carbon::parse($booking->created_at);
//        $endDate = Carbon::parse($booking->to);
//        $date_returned = Carbon::parse($booking->date_returned);        //null ga teng bo'lsa                        //$date_returned == $0rder->deleted_at
//      //        if( isset($request->client_id) &&  !$date_returned->between($startDate, $endDate)
//    )
//    {
        $client_id = $request->get('client_id');
        $status = $request->get('status_id');
        foreach ($request->books as $book) {
            $request->user()->bookings()->create([
                'book_id' => $book['book_id'],
                'client_id' => $client_id,
                'status_id' => $status,
                'to' => $book['to']
            ]);


            $booking = Book::query()->where('id', '=', $book['book_id'])->decrement('quantity');

//    }
//            return $this->error('The reader has a book that has not been returned on time');

        }
        return $this->success('booking created', $booking);

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
        return $this->success('booking deleted');
    }

    public function booksReturnedToday()
    {
        $data_should = Booking::whereDate('to', Carbon::today())->get();
         return $this->response(BookingResource::collection($data_should));
    }
}
