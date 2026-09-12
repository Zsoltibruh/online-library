<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function login(LoginAuthRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'credentials' => 'Invalid email or password'
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasLostBook()) {
            return redirect()->intended()->with('warning', 'You can\' reserve more books until you return your lost book');
        }

        return redirect()->intended();
    }

    public function register(RegisterAuthRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        User::create($credentials);

        return redirect()->intended('/login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
