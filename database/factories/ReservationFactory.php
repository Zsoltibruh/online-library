<?php

namespace Database\Factories;

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
        $reservedAt = fake()->dateTimeBetween('-2 months', 'now');
        $dueAt = (clone $reservedAt)->modify('+' . fake()->numberBetween(7, 21) . ' days');

        return [
            'book_id' => Book::factory(),
            'user_id' => User::factory(),
            'date' => $reservedAt,
            'return_date' => $dueAt,
            'actual_return_date' => fake()->boolean(70)
                ? fake()->dateTimeBetween($reservedAt, 'now')
                : null,
        ];
    }
}
