@extends('layout.main')

@section('content')
    <h1 class="text-2xl">Reservations</h1>
    <x-tables.reservations :reservations="$reservations" />
@endsection
