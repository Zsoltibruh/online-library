<dialog id="addAuthor" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Add author</h3>
        <form action="{{ route('authors.store') }}" method="post">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 text-base">
                <label class="label" for="name">Name</label>
                <input type="name" class="input" id="name" name="name" placeholder="e.g.: Sir Arthur Camelot"
                    required />

                <label class="label" for="birth">Birth date</label>
                <input type="date" class="input" id="birth" name="birth" value="{{ old('birth') }}"
                    required />

                <button type="submit" class="btn btn-primary">Add author</button>
            </fieldset>
        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
