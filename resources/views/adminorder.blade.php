@extends('layout.admin_master')

@section('title', 'Adminside vieworder')

@section('content')

<h6 class="mb-3">ADMINSIDE TO VIEW ALL USERORDER</h6>
<!-- Search form -->
<form action="#" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search...">
        <button type="submit" class="btn btn-primary">Search Order</button>
    </div>
</form>

<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Type Of Item</th>
                <th>Dimensions</th>
                <th>From</th>
                <th>To</th>
                <th>Drop-Off Warehouse</th>
                <th>Receiver Name</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Mode of Transport</th>
                <th>Shipping Date</th>
                <th>Subtotal</th>
                <th>Shipping Fee</th>
                <th>Total Payment</th>
                <th>STATUS</th>
                <th>Action</th> <!-- Added column for action buttons -->
            </tr>
        </thead>
        <tbody>
            @foreach ($userOrderDetails as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->user->firstname }}</td>
                <td>{{ $order->user->lastname }}</td>
                <td>{{ $order->user->email }}</td>
                <td>{{ $order->user->contact }}</td>
                <td>{{ $order->item }}</td>
                <td>{{ $order->dimensions }}</td>
                <td>{{ $order->LocationFrom }}</td>
                <td>{{ $order->LocationTo }}</td>
                <td>{{ $order->DropOffWarehouse }}</td>
                <td>{{ $order->consigneeName }}</td>
                <td>{{ $order->contact }}</td>
                <td>{{ $order->receiveraddress }}</td>
                <td>{{ $order->modeSelection }}</td>
                <td>{{ $order->deliveryDate }}</td>
                <td>{{ $order->price }}</td>
                <td>{{ $order->fee }}</td>
                <td>{{ $order->totalAmount }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <form method="POST" action="{{ route('order.delete', $order->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <!-- UPDATE FORM -->
                    <br>
                    <form method="POST" action="#">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var indicator = document.getElementById('nav-indicator');
        var activeLink = document.querySelector('.side-menu a.active');
        if (activeLink) {
            var linkRect = activeLink.getBoundingClientRect();
            indicator.innerHTML = activeLink.textContent;
            indicator.style.width = linkRect.width + 'px';
            indicator.style.left = linkRect.left + 'px';
        }
    });
</script>
