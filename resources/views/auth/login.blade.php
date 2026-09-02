@extends('layout.main')

@section('content')
    <form action="{{ route('auth.login') }}" method="post">
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4">
            <legend class="fieldset-legend">Login</legend>

            <label class="label" for="email">Email</label>
            <input type="email" class="input" id="email" name="email" placeholder="Email" required />

            <label class="label" for="password">Password</label>
            <input type="password" class="input" id="password" name="password" placeholder="Password" required />

            <button type="submit" class="btn btn-neutral mt-4">Login</button>
        </fieldset>
    </form>
@endsection
