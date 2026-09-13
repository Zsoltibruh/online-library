@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Users</h1>
    <x-display.table :headers="['Name', 'Email', 'Join date', 'Actions']">
        @foreach ($users as $user)
            <tr class="hover:bg-base-300">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td><button type="submit" class="btn btn-primary"
                        onclick="showUser{{ $user->id }}.showModal()">View</button></td>
            </tr>
            <x-modals.user_show :user="$user" />
        @endforeach
    </x-display.table>
    {{ $users->links() }}
@endsection
