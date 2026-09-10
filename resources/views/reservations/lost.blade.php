@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Lost reservations</h1>
    <x-tables.lost_reservations :lostBooks="$lostBooks" />
@endsection
