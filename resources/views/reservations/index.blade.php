@extends('layout.main')

@php
    use App\Enums\ReservationStatus;
@endphp

@section('content')
    <h1 class="text-2xl">Previous reservations</h1>
    <x-display.table :headers="['Book', 'Member', 'Reserved date', 'Due date', 'Status']">
        @foreach ($reservations as $reservation)
            <tr class="hover:bg-base-300">
                <td>{{ $reservation->book->title }}</td>
                <td>{{ $reservation->user->name }}</td>
                <td>{{ $reservation->reservation_date }}</td>
                <td>{{ $reservation->due_date }}</td>
                <td><x-display.status_badge :status="$reservation->status" /></td>
            </tr>
        @endforeach
    </x-display.table>
    {{ $reservations->links() }}
@endsection
