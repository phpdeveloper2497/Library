<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Book;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth:sanctum');
    }

    public function index()
    {
//        dd(new OrderResource(Order::all()));
        return $this->response(OrderResource::collection(auth()->user()->orders()->get()));
    }


    public function store(StoreOrderRequest $request, /*array $books*/)
    {

//        $startDate = Carbon::parse($order->created_at);
//        $endDate = Carbon::parse($order->to);
//        $date_returned = Carbon::parse($order->date_returned);        //null ga teng bo'lsa                        //$date_returned == $0rder->deleted_at
//      //        if( isset($request->client_id) &&  !$date_returned->between($startDate, $endDate)
//    )
//    {
        $client_id = $request->get('client_id');
        $status = $request->get('status_id');
        foreach ($request->books as $book) {
            $request->user()->orders()->create([
                'book_id' => $book['book_id'],
                'client_id' => $client_id,
                'status_id' => $status,
                'to' => $book['to']
            ]);


            $order = Book::query()->where('id', '=', $book['book_id'])->decrement('quantity');

//    }
//            return $this->error('The reader has a book that has not been returned on time');

        }
        return $this->success('orders created');

    }


    public function show(Order $order)
    {
        return $this->response(new OrderResource($order));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
//        dd($order);
        Book::query()->where('id', '=', $order['book_id'])->increment('quantity');
        $order->delete();
        return $this->success('order deleted');
    }
}
