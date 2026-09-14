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
        <nav class="navbar bg-base-200 shadow-sm">
            <div class="flex-1">
                <a href="{{ route('welcome') }}" class="btn btn-ghost text-xl">Online library</a>
            </div>
            <div class="flex-none">
                <ul class="menu menu-horizontal px-1">
                    @auth
                        @can('manage-library')
                            <li><a href="{{ route('authors.index') }}">Manage authors</a></li>
                            <li><a href="{{ route('books.index') }}">Manage books</a></li>
                            <li><a href="{{ route('users.index') }}">Members</a></li>
                            <li>
                                <details class="z-50">
                                    <summary>Manage reservations</summary>
                                    <ul class="bg-base-100 rounded-t-none p-2">
                                        <li><a href="{{ route('reservations.active') }}">Active reservations</a></li>
                                        <li><a href="{{ route('reservations.lost') }}">Lost reservations</a></li>
                                        <li><a href="{{ route('reservations.overdue') }}">Overdue reservations</a></li>
                                        <li><a href="{{ route('reservations.index') }}">Previous reservations</a></li>
                                    </ul>
                                </details>
                            </li>
                        @endcan
                        <li><a href="{{ route('books.list') }}">Books</a></li>
                        <li>
                            <details class="z-50">
                                <summary>Profile</summary>
                                <ul class="bg-base-100 rounded-t-none p-2">
                                    <li><a href="{{ route('users.show', auth()->user()) }}"> {{ auth()->user()->name }}
                                        </a></li>
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
                        <li><a href="{{ route('show_login') }}">Login</a></li>
                        <li><a href="{{ route('show_register') }}">Register</a></li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    <div class="flex flex-col items-center justify-center w-full p-2 lg:grow">
        @yield('content')
    </div>
</body>

</html>
