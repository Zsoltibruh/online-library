@extends('layout.main')

@section('content')
    <form action="{{ route('auth.register') }}" method="post">
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 text-lg">
            <legend class="fieldset-legend">Register</legend>

            <label class="label" for="name">Name</label>
            <input type="text" class="input" id="name" name="name" placeholder="Cool name" required />

            <label class="label" for="email">Email</label>
            <input type="email" class="input @error('email') input-error @enderror" id="email" name="email"
                placeholder="Email" required />
            @error('email')
                <p class="text-error">{{ $message }}</p>
            @enderror

            <label class="label" for="password">Password</label>
            <input type="password" class="input" id="password" name="password" placeholder="Password" required>
            @error('password')
                <p class="text-error">{{ $message }}</p>
            @enderror

            <label class="label" for="password_confirmation">Confirm Password</label>
            <input type="password" class="input" id="password_confirmation" name="password_confirmation"
                placeholder="Password again">
            @error('password')
                <p class="text-error">{{ $message }}</p>
            @enderror

            <button type="submit" class="btn btn-neutral mt-4">Register</button>
        </fieldset>
    </form>
@endsection
