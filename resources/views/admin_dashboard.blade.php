@extends('layout.admin_master')

@section('content')

<!-- Insights -->
<ul class="insights">
    <li>
        <i class='bx bxs-cart'></i>
        <span class="info">
            <h3>
                {{ $orderCount }}
            </h3>
            <p>Number of Order</p>
        </span>
    </li>
</ul>
<!-- End of Insights -->
@endsection
