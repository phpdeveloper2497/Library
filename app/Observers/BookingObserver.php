<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Facades\Notification;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        $notification = ucfirst($booking->status->code);
        $class = "\App\Notifications\Booking\\" . $notification;

        if (class_exists($class))
        {
            Notification::send([$booking->client], new $class($booking));
        }
    }

    /**
     * Handle the Booking "updated" event.
     */
    public function updated(Booking $booking): void
    {
//        $notification = ucfirst($booking->status->code);
//        $class = "\App\Notifications\Booking\\" . $notification;
//
//        if (class_exists($class))
//        {
//            Notification::send([$booking->client], $class($booking));
//        }

    }
    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "restored" event.
     */
    public function restored(Booking $booking): void
    {
        //
    }

    /**
     * Handle the Booking "force deleted" event.
     */
    public function forceDeleted(Booking $booking): void
    {
        //
    }
}
