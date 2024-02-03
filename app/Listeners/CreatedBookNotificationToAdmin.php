<?php

namespace App\Listeners;

use App\Events\Book\CreatedBook;
use Illuminate\Support\Facades\Log;

class CreatedBookNotificationToAdmin
{

    public function __construct()
    {
    }


    /**
     * Handle the event.
     */
    public function handle(CreatedBook $event): void
    {
        Log::alert("Book created successfully. Book name " . $event->book->name);

    }
}
