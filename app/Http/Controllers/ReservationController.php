<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Http\Requests\ReservationRequest;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $reservations = Reservation::orderBy('reservation_date')
            ->with(['user:id,name', 'book:id,title'])
            ->paginate(15);

        return view('reservations.index', [
            'reservations' => $reservations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $book = Book::find($validated['book_id']);

        if ($book->count === 0) {
            return redirect()->route('books.index');
        }

        DB::transaction(function () use ($book, $validated) {
            $book->count = $book->count - 1;
            $book->save();
            Reservation::create([
                'book_id' => $validated['book_id'],
                'user_id' => $validated['user_id'],
                'reservation_date' => now(),
                'due_date' => now()->addMonths(2),
                'status' => ReservationStatus::Reserved,
            ]);
        });

        return redirect()->route('reservations.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $book = Book::find($reservation->book_id);

        DB::transaction(function () use ($book, $reservation) {
            $book->count = $book->count + 1;
            $reservation->return_date = now();
            $reservation->status = ReservationStatus::Returned;
            $book->save();
            $reservation->save();
        });

        return redirect()->route('reservations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
