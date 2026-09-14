<dialog id="showAuthor{{ $author->id }}" class="modal">
    <div class="modal-box">
        <h3 class="text-2xl font-bold">{{ $author->name }}</h3>
        <div class="divider"></div>
        <p class="font-bold">Birth date</p>
        <p>{{ $author->birth }}</p>
        <p class="font-bold">Written books</p>
        <ul class="list">
            @foreach ($author->books as $book)
                <li class="list-row">{{ $book->title }}</li>
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
