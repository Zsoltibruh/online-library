@php
    use App\Enums\ReservationStatus;
@endphp

@props(['status'])

@php
    $class = match ($status) {
        ReservationStatus::Reserved => 'badge-info',
        ReservationStatus::Returned => 'badge-success',
        ReservationStatus::ReturnedLate => 'badge-warning',
        default => 'badge-info',
    };
@endphp

<div class="badge {{ $class }}">
    {{ $status->label() }}
</div>
