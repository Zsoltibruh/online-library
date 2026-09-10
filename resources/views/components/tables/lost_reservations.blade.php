<div class="overflow-x-auto w-full">
    <table class="table table-zebra">
        <thead>
            <tr>
                <th>Book</th>
                <th>Author(s)</th>
                <th>Member data</th>
                <th>Reservation date</th>
                <th>Due date</th>
                <th>Logger</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
    {{ $lostBooks->links() }}
</div>
