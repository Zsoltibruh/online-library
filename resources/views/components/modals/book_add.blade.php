<dialog id="addBook" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Add book</h3>
        <form action="{{ route('books.store') }}" method="post">
            @csrf
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 text-base">
                <label class="label" for="title">Title</label>
                <input type="text" class="input" id="title" name="title" placeholder="e.g.: Dune" required />

                <label class="label" for="birth">Publication year</label>
                <input type="number" class="input" id="publication_year" name="publication_year" required />

                <label class="label" for="count">Count</label>
                <input type="number" class="input" name="count" id="count" required>

                <label class="label" for="authors">Authors</label>
                <select class="select h-auto" id="authors" name="author_ids[]" multiple required>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">
                            {{ $author->name }}
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
