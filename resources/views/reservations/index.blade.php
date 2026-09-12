@extends('layout.main')

@php
    use App\Enums\ReservationStatus;
@endphp

@section('content')
    <h1 class="text-2xl">Reservations</h1>
    <x-display.table :headers="['Book', 'Member', 'Reserved date', 'Due date', 'Status', 'Actions']">
        @foreach ($reservations as $reservation)
            <tr class="hover:bg-base-300">
                <td>{{ $reservation->book->title }}</td>
                <td>{{ $reservation->user->name }}</td>
                <td>{{ $reservation->reservation_date }}</td>
                <td>{{ $reservation->due_date }}</td>
                <td>
                    @if ($reservation->isExpired())
                        <x-display.status_badge :status="ReservationStatus::Lost" />
                    @else
                        <x-display.status_badge :status="$reservation->status" />
                    @endif
                </td>
                <td class="flex gap-2">
                    <form action="{{ route('reservations.return', $reservation) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="btn btn-info
                                @if (!$reservation->canReturn()) btn-disabled @endif">Return</button>
                    </form>
                    @if ($reservation->isExpired())
                        <form action="{{ route('lost_books.mark_as_lost', $reservation) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-error">Mark as
                                lost</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </x-display.table>
    {{ $reservations->links() }}
@endsection
