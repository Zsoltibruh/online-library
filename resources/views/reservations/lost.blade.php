@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Lost reservations</h1>
    <x-display.table :headers="['Book', 'Author(s)', 'Member data', 'Reservation date', 'Due date', 'Logger', 'Actions']">
        @foreach ($lostBooks as $lostBook)
            <tr class="hover:bg-base-300">
                <td>{{ $lostBook->reservation->book->title }}</td>
                <td>
                    <ul class="list">
                        @foreach ($lostBook->reservation->book->authors as $author)
                            <li>{{ $author->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul class="list">
                        <li class="list-row">{{ $lostBook->reservation->user->name }}</li>
                        <li class="list-row">{{ $lostBook->reservation->user->email }}</li>
                    </ul>
                </td>
                <td>{{ $lostBook->reservation->reservation_date }}</td>
                <td>{{ $lostBook->reservation->due_date }}</td>
                <td>{{ $lostBook->logger }}</td>
                <td>
                    <form action="{{ route('lost_books.return', $lostBook) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-info
                                ">Return</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </x-display.table>
    {{ $lostBooks->links() }}
@endsection
