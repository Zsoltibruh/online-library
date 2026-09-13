@php
    use App\Enums\ReservationStatus;
@endphp

@props(['status'])

@php
    $class = match ($status) {
        ReservationStatus::Reserved => 'badge-info',
        ReservationStatus::Returned => 'badge-success',
        ReservationStatus::ReturnedLate => 'badge-warning',
        ReservationStatus::Lost => 'badge-error',
        default => 'badge-info',
    };
@endphp

<div class="badge {{ $class }}">
    @switch($status)
        @case(ReservationStatus::ReturnedLate)
            <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                <g fill="currentColor">
                    <path
                        d="M7.638,3.495L2.213,12.891c-.605,1.048,.151,2.359,1.362,2.359H14.425c1.211,0,1.967-1.31,1.362-2.359L10.362,3.495c-.605-1.048-2.119-1.048-2.724,0Z"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                    </path>
                    <line x1="9" y1="6.5" x2="9" y2="10" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></line>
                    <path d="M9,13.569c-.552,0-1-.449-1-1s.448-1,1-1,1,.449,1,1-.448,1-1,1Z" fill="currentColor"
                        data-stroke="none" stroke="none"></path>
                </g>
            </svg>
        @break

        @default
            <svg class="size-[1em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g fill="currentColor" stroke-linejoin="miter" stroke-linecap="butt">
                    <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-linecap="square"
                        stroke-miterlimit="10" stroke-width="2"></circle>
                    <polyline points="7 13 10 16 17 8" fill="none" stroke="currentColor" stroke-linecap="square"
                        stroke-miterlimit="10" stroke-width="2"></polyline>
                </g>
            </svg>
    @endswitch
    {{ $status->label() }}
</div>
