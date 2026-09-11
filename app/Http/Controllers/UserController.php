<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::select(['id', 'name', 'email', 'created_at'])
            ->with(['reservations' => function ($query) {
                $query->where('status', '=', ReservationStatus::Reserved);
            }, 'reservations.book'])
            ->where('role', UserRole::Member)
            ->orderBy('name')
            ->paginate(15);

        return view('users.index', [
            'users' => $users,
        ]);
    }
}
