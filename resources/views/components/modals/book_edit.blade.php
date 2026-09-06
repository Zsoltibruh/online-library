<dialog id="editBook{{ $book->id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Edit {{ $book->title }}</h3>
        <form action="{{ route('books.update', $book) }}" method="post">
            @csrf
            @method('PATCH')
            <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 text-base">
                <label class="label" for="title">Title</label>
                <input type="text" class="input" id="title" name="title" placeholder="e.g.: Dune"
                    value="{{ $book->title }}" required />

                <label class="label" for="birth">Publication year</label>
                <input type="number" class="input" id="publication_year" name="publication_year"
                    value="{{ $book->publication_year }}" required />

                <label class="label" for="count">Count</label>
                <input type="number" class="input" name="count" id="count" value="{{ $book->count }}" required>

                <select class="select h-auto" id="authors" name="author_ids[]" multiple required>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @selected($book->authors->contains($author))>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn btn-primary">Edit book</button>
            </fieldset>
        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
