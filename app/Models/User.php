<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\ReservationStatus;
use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function activeReservations(): HasMany
    {
        return $this->hasMany(Reservation::class)->where(['status' => ReservationStatus::Reserved]);
    }

    public function overdueReservations(): HasMany
    {
        return $this->hasMany(Reservation::class)
            ->whereNull('return_date')
            ->where('due_date', '<', now())
            ->where('status', '!=', ReservationStatus::Lost);
    }

    public function previousReservations(): HasMany
    {
        return $this->hasMany(Reservation::class)
            ->whereIn('status', [ReservationStatus::Returned, ReservationStatus::ReturnedLate]);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function hasLostBook(): bool
    {
        return $this->reservations()->whereHas('lostBooks')->exists();
    }
}
