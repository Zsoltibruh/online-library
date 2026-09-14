@extends('layout.main')

@section('content')
    <div class="hero bg-base-200 min-h-full">
        <div class="hero-content text-center">
            <div class="min-w-7xl">
                <h1 class="text-5xl font-bold">{{ $user->name }}</h1>
                <div class="divider"></div>
                <div class="stats bg-neutral">
                    <div class="stat place-items-center">
                        <div class="stat-title">Join date</div>
                        <div class="stat-value">{{ $user->created_at }}</div>
                    </div>

                    <div class="stat place-items-center">
                        <div class="stat-title">Active reservations</div>
                        <div class="stat-value">{{ $user->active_reservations_count }}</div>
                    </div>

                    <div class="stat place-items-center">
                        <div class="stat-title">Previous reservations</div>
                        <div class="stat-value">{{ $user->previous_reservations_count }}</div>
                    </div>

                    <div class="stat place-items-center">
                        <div class="stat-title">Overdue reservations</div>
                        <div class="stat-value">{{ $user->overdue_reservations_count }}</div>
                    </div>
                </div>

                <div class="divider"></div>

                <div class="flex flex-row gap-4 justify-around">
                    <div class="flex flex-col gap-2">
                        <h2 class="text-lg font-bold">Active reservations</h2>
                        <x-display.table :headers="['Book', 'Reserved date', 'Due date']">
                            @forelse ($user->activeReservations as $reservation)
                                <tr class="hover:bg-base-300">
                                    <td>{{ $reservation->book->title }}</td>
                                    <td>{{ $reservation->reservation_date }}</td>
                                    <td>{{ $reservation->due_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <p>No active reservations</p>
                                    </td>
                                </tr>
                            @endforelse
                        </x-display.table>
                    </div>

                    <div class="flex flex-col gap-2">
                        <h2 class="text-lg font-bold">Previous reservations</h2>
                        <x-display.table :headers="['Book', 'Reserved date', 'Due date']">
                            @forelse ($user->previousReservations as $reservation)
                                <tr class="hover:bg-base-300">
                                    <td>{{ $reservation->book->title }}</td>
                                    <td>{{ $reservation->reservation_date }}</td>
                                    <td>{{ $reservation->due_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <p>No previous reservations</p>
                                    </td>
                                </tr>
                            @endforelse
                        </x-display.table>
                    </div>

                    <div class="flex flex-col gap-2">
                        <h2 class="text-lg font-bold">Overdue reservations</h2>
                        <x-display.table :headers="['Book', 'Reserved date', 'Due date']">
                            @forelse ($user->overdueReservations as $reservation)
                                <tr class="hover:bg-base-300">
                                    <td>{{ $reservation->book->title }}</td>
                                    <td>{{ $reservation->reservation_date }}</td>
                                    <td>{{ $reservation->due_date }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td>
                                        <p>No overdue reservations</p>
                                    </td>
                                </tr>
                            @endforelse
                        </x-display.table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
