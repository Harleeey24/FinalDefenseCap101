@extends('layout.master')

@section('content')

<!-- Insights -->
<ul class="insights">
    <li>
        <i class='bx bx-calendar-check'></i>
        <span class="info">
            <h3>
                {{ $orderUserCount }}
            </h3>
            <p>Your Current Orders</p>
        </span>
    </li>
    <!-- Other insights -->
</ul>
<!-- End of Insights -->
@endsection
