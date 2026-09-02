@extends('layout.main')

@section('content')
    <form action="{{ route('auth.register') }}" method="post">
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend">Register</legend>

            <label class="label" for="name">Name</label>
            <input type="text" class="input" id="name" name="name" placeholder="Cool name" required />

            <label class="label" for="email">Email</label>
            <input type="email" class="input" id="email" name="email" placeholder="Email" required />

            <label class="label" for="password">Password</label>
            <input type="password" class="input" id="password" name="password" placeholder="Password" required>

            <label class="label" for="password_confirmation">Confirm Password</label>
            <input type="password" class="input" id="password_confirmation" name="password_confirmation"
                placeholder="Password again">

            <button type="submit" class="btn btn-neutral mt-4">Register</button>
        </fieldset>
    </form>
@endsection
