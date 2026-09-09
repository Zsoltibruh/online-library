<dialog id="showAuthor{{ $author->id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">{{ $author->name }}</h3>
        <p>Full name: {{ $author->name }}</p>
        <p>Birth date: {{ $author->birth }}</p>
        <p>Written books:</p>
        <ul class="list">
            @foreach ($author->books as $book)
                <li class="list-row">{{ $book->title }}</li>
            @endforeach
        </ul>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
