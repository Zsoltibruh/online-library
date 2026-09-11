<?php

namespace Database\Factories;

use App\Enums\ReservationStatus;
use App\Enums\UserRole;
use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $book = Book::inRandomOrder()->first();
        $user = User::inRandomOrder()->where(['role' => UserRole::Member])->first();
        $reservedAt = fake()->dateTimeBetween('-4 months', 'now');
        $dueAt = (clone $reservedAt)->modify('+ 2 month');
        $returnedAt = fake()->boolean(70)
            ? fake()->dateTimeBetween($reservedAt, 'now')
            : null;

        $status = match (true) {
            $returnedAt === null && $dueAt < now() => ReservationStatus::Reserved,
            $returnedAt === null => ReservationStatus::Reserved,
            $returnedAt > $dueAt => ReservationStatus::ReturnedLate,
            default => ReservationStatus::Returned,
        };

        return [
            'book_id' => $book,
            'user_id' => $user,
            'reservation_date' => $reservedAt,
            'due_date' => $dueAt,
            'return_date' => $returnedAt,
            'status' => $status,
        ];
    }
}
