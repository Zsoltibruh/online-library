@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Reservations</h1>
    <div class="overflow-x-auto w-full">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Member</th>
                    <th>Reserved date</th>
                    <th>Due date</th>
                    <th>Return date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr class="hover:bg-base-300">
                        <td>{{ $reservation->book->title }}</td>
                        <td>{{ $reservation->user->name }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->return_date }}</td>
                        <td class="@if ($reservation->actual_return_date > $reservation->return_date) text-error @endif">
                            {{ $reservation->actual_return_date ?? '-' }}</td>
                        <td>
                            <form action="" method="post">
                                <button type="submit" class="btn btn-warning">Send return notice</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $reservations->links() }}
    </div>
@endsection
