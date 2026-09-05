@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Users</h1>
    <div class="overflow-x-auto w-full">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Join date</th>
                    <th>Reserved books</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="hover:bg-base-300">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <ul class="list">
                                <li>Book 1</li>
                                <li>Book 2</li>
                                <li>Book 3</li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
