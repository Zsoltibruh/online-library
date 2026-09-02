<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Online library')</title>

    @fonts

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <header>
        <nav class="navbar bg-base-100 shadow-sm">
            <div class="flex-1">
                <a href="{{ route('welcome') }}" class="btn btn-ghost text-xl">Online library</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    @auth
                        <li><a>Link</a></li>
                        <li>
                            <details>
                                <summary>Profile</summary>
                                <ul class="bg-base-100 rounded-t-none p-2">
                                    <li><a> {{ auth()->user()->name }} </a></li>
                                    <li>
                                        <form action="/logout" method="post">
                                            <button type="submit" class="link link-hover no-underline">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </details>
                        </li>
                    @endauth

                    @guest
                        <li><a href="{{ route('auth.login') }}">Login</a></li>
                        <li><a href="{{ route('auth.register') }}">Register</a></li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        @yield('content')
    </div>
</body>

</html>
