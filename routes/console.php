<?php

use App\Mail\ReservationReminder;
use App\Models\Reservation;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
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
