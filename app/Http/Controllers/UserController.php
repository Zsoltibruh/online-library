<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->search;

        $users = User::select(['id', 'name', 'email', 'created_at'])
            ->with([
                'activeReservations.book:id,title',
                'overdueReservations.book:id,title',
                'previousReservations.book:id,title',
            ])
            ->when($search, function ($query, $search) {
                $query->whereFullText(['name', 'email'], $search);
            })
            ->where('role', UserRole::Member)
            ->orderBy('name')
            ->paginate(15);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    public function show(User $user): View
    {
        $user = User::with([
            'activeReservations',
            'previousReservations',
            'overdueReservations',
        ])
            ->withCount([
                'activeReservations',
                'previousReservations',
                'overdueReservations',
            ])
            ->find($user->id);

        return view('users.show', [
            'user' => $user,
        ]);
    }
}
