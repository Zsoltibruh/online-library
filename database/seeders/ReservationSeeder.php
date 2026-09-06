<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $users = User::where(['role' => UserRole::Member])->get();

        Reservation::factory()
            ->count(20)
            ->make()
            ->each(function (Reservation $reservation) use ($books, $users) {
                $reservation->book_id = $books->random()->id;
                $reservation->user_id = $users->random()->id;
                $reservation->save();
            });
    }
}
