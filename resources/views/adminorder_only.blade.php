@extends('layout.admin_master')

@section('title', 'VIEWORDER')

@section('content')

<!-- Display the order details -->
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userOrderDetails as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
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
                     <button type="submit" class="btn btn-danger">Delete Order</button>
                     <br><br>
                     <a href="youtube.com" class="btn btn-success">Pay Now</a>
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
