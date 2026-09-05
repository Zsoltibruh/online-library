@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Books</h1>
    <button class="btn btn-primary" onclick="addBook.showModal()">Add new book</button>
    <div class="overflow-x-auto w-full">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Publication year</th>
                    <th>In storage</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr class="hover:bg-base-300">
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->publication_year }}</td>
                        <td>{{ $book->count }}</td>
                        <td class="flex gap-2">
                            <a href=""
                                class="btn btn-secondary @if ($book->count === 0) btn-disabled @endif">Reserve</a>
                            <button class="btn btn-info" onclick="editBook{{ $book->id }}.showModal()">Edit</button>
                            <form action="{{ route('books.destroy', $book) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <dialog id="editBook{{ $book->id }}" class="modal">
                        <div class="modal-box">
                            <h3 class="text-lg font-bold">Edit book</h3>
                            <form action="{{ route('books.update', $book) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <fieldset
                                    class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 text-base">
                                    <label class="label" for="title">Title</label>
                                    <input type="text" class="input" id="title" name="title"
                                        placeholder="e.g.: Dune" value="{{ $book->title }}" required />

                                    <label class="label" for="birth">Publication year</label>
                                    <input type="number" class="input" id="publication_year" name="publication_year"
                                        value="{{ $book->publication_year }}" required />

                                    <label class="label" for="count">Count</label>
                                    <input type="number" class="input" name="count" id="count"
                                        value="{{ $book->count }}" required>

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
                @endforeach
            </tbody>
        </table>
        {{ $books->links() }}
    </div>

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
@endsection
