@php
    $segments = request()->segments();
@endphp

@if(count($segments) > 0)
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white px-3 py-2 rounded shadow-sm">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>

        @foreach($segments as $segment)
            @php
                $segment = ucfirst(str_replace('-', ' ', $segment));
            @endphp
            <li class="breadcrumb-item active">{{ $segment }}</li>
        @endforeach
    </ol>
</nav>
@endif
