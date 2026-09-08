<div class="overflow-x-auto w-full">
    <table class="table table-zebra">
        <thead>
            <tr>
                <th>Book</th>
                <th>Member</th>
                <th>Reserved date</th>
                <th>Due date</th>
                <th>Return date</th>
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
                    <td>{{ $reservation->return_date ?? '-' }}</td>
                    <td><x-display.status_badge :status="$reservation->status" /></td>
                    <td class="flex gap-2">
                        <form action="" method="post">
                            <button type="submit"
                                class="btn btn-warning
                                @if (!$reservation->canSendReturnNotice()) btn-disabled @endif">Send
                                return notice</button>
                        </form>
                        <form action="" method="post">
                            <button type="submit"
                                class="btn btn-info
                                @if (!$reservation->canReturn()) btn-disabled @endif">Return</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reservations->links() }}
</div>
