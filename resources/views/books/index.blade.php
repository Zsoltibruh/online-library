@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Books</h1>
    <div class="flex flex-col gap-2 content-around w-full">
        <button class="btn btn-primary w-max" onclick="addBook.showModal()">Add new book</button>
        <x-forms.search :route="route('books.index')" />
    </div>
    <div class="divider"></div>
    <x-display.table :headers="['Title', 'Actions']">
        @foreach ($books as $book)
            <tr class="hover:bg-base-300">
                <td>{{ $book->title }}</td>
                <td class="flex gap-2">
                    <button type="submit" class="btn btn-secondary"
                        onclick="reserveBook{{ $book->id }}.showModal()">Reserve</button>
                    <button type="submit" class="btn btn-primary"
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
    </x-display.table>
    {{ $books->links() }}
    <x-modals.book_add :authors="$authors" />
@endsection
