@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Authors</h1>
    <button class="btn btn-primary" onclick="addAuthor.showModal()">Add new author</button>
    <div class="overflow-x-auto w-full">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Birth date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                    <tr class="hover:bg-base-300">
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->birth }}</td>
                        <td class="flex gap-2">
                            <button class="btn btn-info" onclick="editAuthor{{ $author->id }}.showModal()">Edit</button>
                            <form action="{{ route('authors.destroy', $author) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <dialog id="editAuthor{{ $author->id }}" class="modal">
                        <div class="modal-box">
                            <h3 class="text-lg font-bold">Edit author</h3>
                            <form action="{{ route('authors.update', $author) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <fieldset
                                    class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 text-base">
                                    <label class="label" for="name">Name</label>
                                    <input type="name" class="input" id="name" name="name"
                                        placeholder="e.g.: Sir Arthur Camelot" value="{{ old('name', $author->name) }}"
                                        required />

                                    <label class="label" for="birth">Birth date</label>
                                    <input type="date" class="input" id="birth" name="birth"
                                        value="{{ old('birth', $author->birth) }}" value="{{ $author->birth }}" required />

                                    <button type="submit" class="btn btn-primary">Edit author</button>
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
        {{ $authors->links() }}
    </div>

    <dialog id="addAuthor" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Add author</h3>
            <form action="{{ route('authors.store') }}" method="post">
                @csrf
                <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 text-base">
                    <label class="label" for="name">Name</label>
                    <input type="name" class="input" id="name" name="name"
                        placeholder="e.g.: Sir Arthur Camelot" required />

                    <label class="label" for="birth">Birth date</label>
                    <input type="date" class="input" id="birth" name="birth" value="{{ old('birth') }}"
                        required />

                    <button type="submit" class="btn btn-primary">Add author</button>
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
