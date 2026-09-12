@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Authors</h1>
    <button class="btn btn-primary" onclick="addAuthor.showModal()">Add new author</button>
    <x-forms.search :route="route('authors.index')" />

    <x-display.table :headers="['Name', 'Actions']">
        @foreach ($authors as $author)
            <tr class="hover:bg-base-300">
                <td>{{ $author->name }}</td>
                <td class="flex gap-2">
                    <button type="submit" class="btn btn-neutral"
                        onclick="showAuthor{{ $author->id }}.showModal()">View</button>
                    <button class="btn btn-info" onclick="editAuthor{{ $author->id }}.showModal()">Edit</button>
                    <form action="{{ route('authors.destroy', $author) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error">Delete</button>
                    </form>
                </td>
            </tr>

            <x-modals.author_edit :author="$author" />
            <x-modals.author_show :author="$author" />
        @endforeach
    </x-display.table>
    {{ $authors->links() }}
    <x-modals.author_add />
@endsection
