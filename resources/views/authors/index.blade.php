@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Authors</h1>
    <div class="flex flex-col gap-2 content-around w-full">
        <button class="btn btn-primary w-max" onclick="addAuthor.showModal()">Add new author</button>
        <x-forms.search :route="route('authors.index')" />
    </div>
    <div class="divider"></div>

    <x-display.table :headers="['Name', 'Actions']">
        @foreach ($authors as $author)
            <tr class="hover:bg-base-300">
                <td>{{ $author->name }}</td>
                <td class="flex gap-2">
                    <button type="submit" class="btn btn-primary"
                        onclick="showAuthor{{ $author->id }}.showModal()">View</button>
                    <button class="btn btn-info" onclick="editAuthor{{ $author->id }}.showModal()">Edit</button>
                    <form action="{{ route('authors.destroy', $author) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this author?');">
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
