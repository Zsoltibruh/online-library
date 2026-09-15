@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Books</h1>
    <div class="flex flex-col gap-2 content-around w-full">
        <x-forms.search :route="route('books.list')">
            <select class="select w-max" name="category">
                <option disabled selected>Pick a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </x-forms.search>
    </div>
    <div class="divider"></div>
    <x-display.table :headers="['Title', 'Categories', 'Publication year', 'Available to reserve', 'Actions']">
        @foreach ($books as $book)
            <tr class="hover:bg-base-300">
                <td>{{ $book->title }}</td>
                <td>
                    @foreach ($book->categories as $category)
                        {{ $category->name }}{{ $loop->last ? '' : ',' }}
                    @endforeach
                </td>
                <td>{{ $book->publication_year }}</td>
                <td>{{ $book->reservations_count }}</td>
                <td><button type="submit" class="btn btn-primary"
                        onclick="showBook{{ $book->id }}.showModal()">View</button>
                </td>
            </tr>

            <x-modals.book_show :book="$book" />
        @endforeach
    </x-display.table>
    {{ $books->links() }}
@endsection
