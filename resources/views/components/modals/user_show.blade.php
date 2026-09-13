@props(['user'])

<dialog id="showUser{{ $user->id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">{{ $user->name }}</h3>
        <p>Full name: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Join date: {{ $user->created_at }}</p>
        <p>Active reservations:</p>
        <ul class="list">
            @forelse ($user->activeReservations as $reservation)
                <li class="list-row">{{ $reservation->book->title }}</li>
            @empty
                <p>No active reservations</p>
            @endforelse
        </ul>

        <p>Overdue reservations:</p>
        <ul class="list">
            @forelse ($user->overdueReservations as $reservation)
                <li class="list-row">{{ $reservation->book->title }}</li>
            @empty
                <p>No active reservations</p>
            @endforelse
        </ul>

        <p>Previous reservations:</p>
        <ul class="list">
            @forelse ($user->previousReservations as $reservation)
                <li class="list-row">{{ $reservation->book->title }}</li>
            @empty
                <p>No active reservations</p>
            @endforelse
        </ul>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
