<dialog id="editAuthor{{ $author->id }}" class="modal">
    <div class="modal-box w-11/12 max-w-3xl">
        <h3 class="text-2xl font-bold">Edit {{ $author->name }}</h3>
        <div class="divider"></div>
        <form action="{{ route('authors.update', $author) }}" method="post">
            @csrf
            @method('PATCH')
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-full border p-4 text-base">
                <label class="label" for="name">Name</label>
                <input type="text" class="input w-full" id="name" name="name"
                    placeholder="e.g.: Sir Arthur Camelot" value="{{ old('name', $author->name) }}" required />

                <label class="label" for="birth">Birth date</label>
                <input type="date" class="input w-full" id="birth" name="birth"
                    value="{{ old('birth', $author->birth) }}" value="{{ $author->birth }}" required />

                <button type="submit" class="btn btn-primary">Edit author</button>
            </fieldset>
        </form>
        <div class="divider"></div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
