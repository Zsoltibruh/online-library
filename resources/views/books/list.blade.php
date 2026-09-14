@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Books</h1>
    <x-forms.search :route="route('books.list')" />

    <x-display.table :headers="['Title', 'Available to reserve', 'Actions']">
        @foreach ($books as $book)
            <tr class="hover:bg-base-300">
                <td>{{ $book->title }}</td>
                <td>{{ $book->reservations_count }}</td>
                <td><button type="submit" class="btn btn-soft" onclick="showBook{{ $book->id }}.showModal()">View</button>
                </td>
            </tr>

            <x-modals.book_show :book="$book" />
        @endforeach
    </x-display.table>
    {{ $books->links() }}
@endsection
