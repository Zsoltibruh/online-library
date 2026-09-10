<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Models\Book;
use App\Models\LostBook;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class LostBookController extends Controller
{
    public function markAsLost(Reservation $reservation): RedirectResponse
    {
        $book = Book::find($reservation->book_id);

        DB::transaction(function () use ($reservation, $book) {
            $book->decrement('count');
            $reservation->status = ReservationStatus::Overdue;

            LostBook::create([
                'reservation_id' => $reservation->id,
                'logger' => auth()->user()->name,
                'log_date' => now(),
            ]);

            $reservation->save();
            $book->save();
        });

        return redirect()->route('reservations.lost');
    }

    public function return(LostBook $lostBook): RedirectResponse
    {
        DB::transaction(function () use ($lostBook) {
            $lostBook->reservation->book->increment('count');

            $lostBook->reservation->update([
                'return_date' => now(),
                'status' => ReservationStatus::ReturnedLate,
            ]);

            $lostBook->delete();
        });

        return redirect()->route('reservations.index');
    }
}
