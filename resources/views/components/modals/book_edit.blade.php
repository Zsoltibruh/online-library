<dialog id="editBook{{ $book->id }}" class="modal">
    <div class="modal-box w-11/12 max-w-3xl">
        <h3 class="text-2xl font-bold">Edit {{ $book->title }}</h3>
        <div class="divider"></div>
        <form action="{{ route('books.update', $book) }}" method="post">
            @csrf
            @method('PATCH')
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-full border p-4 text-base">
                <label class="label" for="title">Title</label>
                <input type="text" class="input w-full" id="title" name="title" placeholder="e.g.: Dune"
                    value="{{ $book->title }}" required />

                <label class="label" for="birth">Publication year</label>
                <input type="number" class="input w-full" id="publication_year" name="publication_year"
                    value="{{ $book->publication_year }}" required />

                <label class="label" for="count">Count</label>
                <input type="number" class="input w-full" name="count" id="count" value="{{ $book->count }}"
                    required>

                <label for="authors" class="label">Author(s)</label>
                <select class="select h-auto w-full" id="authors" name="author_ids[]" multiple required>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @selected($book->authors->contains($author))>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Edit book</button>
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
