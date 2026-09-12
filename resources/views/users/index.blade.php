@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Users</h1>
    <x-display.table :headers="['Name', 'Email', 'Join date', 'Reserved books']">
        @foreach ($users as $user)
            <tr class="hover:bg-base-300">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <ul class="list">
                        @forelse ($user->reservations as $reservation)
                            <li>{{ $reservation->book->title }}</li>
                        @empty
                            <li>-</li>
                        @endforelse
                    </ul>
                </td>
            </tr>
        @endforeach
    </x-display.table>
    {{ $users->links() }}
@endsection
