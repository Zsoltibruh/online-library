@props(['user'])

<dialog id="showUser{{ $user->id }}" class="modal">
    <div class="modal-box w-11/12 max-w-5xl">
        <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
        <div class="divider"></div>
        <p class="font-bold">Email</p>
        <p>{{ $user->email }}</p>
        <p class="font-bold">Join date</p>
        <p>{{ $user->created_at }}</p>

        <div class="flex flex-row justify-between">
            <div class="flex flex-col gap-2">
                <p class="font-bold">Active reservations</p>
                <ul class="list">
                    @forelse ($user->activeReservations as $reservation)
                        <li class="list-row">{{ $reservation->book->title }}</li>
                    @empty
                        <p class="text-sm text-gray-500">No active reservations</p>
                    @endforelse
                </ul>
            </div>

            <div class="flex flex-col gap-2">
                <p class="font-bold">Overdue reservations</p>
                <ul class="list">
                    @forelse ($user->overdueReservations as $reservation)
                        <li class="list-row">{{ $reservation->book->title }}</li>
                    @empty
                        <p class="text-sm text-gray-500">No overdue reservations</p>
                    @endforelse
                </ul>
            </div>

            <div class="flex flex-col gap-2">
                <p class="font-bold">Previous reservations</p>
                <ul class="list">
                    @forelse ($user->previousReservations as $reservation)
                        <li class="list-row">{{ $reservation->book->title }}</li>
                    @empty
                        <p class="text-sm text-gray-500">No previous reservations</p>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="divider"></div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
