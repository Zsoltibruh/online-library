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
    public function index(): View
    {
        $users = User::select(['name', 'email', 'created_at'])
            ->where('role', UserRole::Member)
            ->orderBy('name')
            ->paginate(15);

        return view('users.index', [
            'users' => $users,
        ]);
    }
}
