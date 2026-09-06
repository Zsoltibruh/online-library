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
                            <button type="submit"
                                class="btn btn-secondary @if ($book->count === 0) btn-disabled @endif"
                                onclick="reserveBook{{ $book->id }}.showModal()">Reserve</button>
                            <button type="submit" class="btn btn-soft"
                                onclick="showBook{{ $book->id }}.showModal()">View</button>
                            <button class="btn btn-info" onclick="editBook{{ $book->id }}.showModal()">Edit</button>
                            <form action="{{ route('books.destroy', $book) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <x-modals.book_reserve :book="$book" :users="$users" />
                    <x-modals.book_show :book="$book" />
                    <x-modals.book_edit :book="$book" :authors="$authors" />
                @endforeach
            </tbody>
        </table>
        {{ $books->links() }}
    </div>

    <x-modals.book_add :authors="$authors" />
@endsection
