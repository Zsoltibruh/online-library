<dialog id="reserveBook{{ $book->id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Reserve {{ $book->title }}</h3>
        <form action="{{ route('reservations.store') }}" method="post">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 text-base">
                <label class="label" for="users">Members</label>
                <select class="select h-auto" id="users" name="user" required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Add book</button>
            </fieldset>
        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
