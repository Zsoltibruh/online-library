<div class="overflow-x-auto w-full">
    <table class="table table-zebra">
        <thead>
            <tr>
                <th>Book</th>
                <th>Member</th>
                <th>Reserved date</th>
                <th>Due date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr class="hover:bg-base-300">
                    <td>{{ $reservation->book->title }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->due_date }}</td>
                    <td><x-display.status_badge :status="$reservation->status" /></td>
                    <td class="flex gap-2">
                        <form action="{{ route('reservations.update', $reservation) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="btn btn-info
                                @if (!$reservation->canReturn()) btn-disabled @endif">Return</button>
                        </form>
                        <form action="" method="post">
                            @csrf
                            <button type="submit" class="btn btn-error">Mark as lost</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reservations->links() }}
</div>
