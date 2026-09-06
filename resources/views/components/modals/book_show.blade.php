<dialog id="showBook{{ $book->id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">{{ $book->title }}</h3>
        <p>Title: {{ $book->title }}</p>
        <p>Publication year: {{ $book->publication_year }}</p>
        <p>Storage count: {{ $book->count }}</p>
        <p>Author(s):</p>
        <ul class="list">
            @foreach ($book->authors as $author)
                <li class="list-row">{{ $author->name }}</li>
            @endforeach
        </ul>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
