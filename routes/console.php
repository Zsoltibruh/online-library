<?php

use App\Enums\ReservationStatus;
use App\Mail\ReservationReminder;
use App\Models\LostBook;
use App\Models\Reservation;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $targetDate = now()->addDays(3)->toDateString();

    $reservations = Reservation::select(['id', 'due_date', 'return_date'])
        ->with(['book:id,title', 'user:id,name'])
        ->whereNull('return_date')
        ->where(['due_date' => $targetDate])
        ->get();

    if (isset($reservations)) {
        foreach ($reservations as $reservation) {
            Mail::to($reservation->user->email)->send(new ReservationReminder($reservation));
        }
    }
})->name('Send reminders 3 days before due date')->daily();

Schedule::call(function () {
    $lostDate = now()->subMonths(2);

    $reservations = Reservation::with(['user:id', 'book:id,count'])
        ->whereNull('return_date')
        ->whereNot('status', '=', ReservationStatus::Lost)
        ->where('due_date', '<=', $lostDate)
        ->get();

    foreach ($reservations as $reservation) {
        DB::transaction(function () use ($reservation) {
            $reservation->book->decrement('count');

            $reservation->update([
                'status' => ReservationStatus::Lost,
            ]);

            LostBook::create([
                'reservation_id' => $reservation->id,
                'logger' => 'System',
                'log_date' => now(),
            ]);
        });
    }
})->name('Mark 2 month old reservations lost')->daily();
