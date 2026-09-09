<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Http\Requests\ReservationRequest;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
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

        $book = Book::withCount(['reservations' => function (Builder $query) {
            $query->where('status', '=', ReservationStatus::Reserved->value);
        }])->find($validated['book_id']);

        if ($book->reservations_count === $book->count) {
            return redirect()->route('books.index');
        }

        Reservation::create([
            'book_id' => $validated['book_id'],
            'user_id' => $validated['user_id'],
            'reservation_date' => now(),
            'due_date' => now()->addMonths(2),
            'status' => ReservationStatus::Reserved,
        ]);

        return redirect()->route('reservations.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Reservation $reservation)
    {
        $reservation->return_date = now();
        $reservation->status = ReservationStatus::Returned;
        $reservation->save();

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
