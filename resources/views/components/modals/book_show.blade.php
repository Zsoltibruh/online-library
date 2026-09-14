<dialog id="showBook{{ $book->id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-2xl font-bold">{{ $book->title }}</h3>
        <div class="divider"></div>
        <p class="font-bold">Publication year</p>
        <p>{{ $book->publication_year }}</p>
        <p class="font-bold">Amount in storage</p>
        <p>{{ $book->count }}</p>
        <p class="font-bold">Author(s):</p>
        <ul class="list">
            @foreach ($book->authors as $author)
                <li class="list-row">{{ $author->name }}</li>
            @endforeach
        </ul>
        <div class="divider"></div>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Close</button>
            </form>
        </div>
    </div>
</dialog>
