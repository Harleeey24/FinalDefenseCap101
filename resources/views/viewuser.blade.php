@extends('layout.admin_master')

@section('title', 'View User')

@section('content')

<style>
    th {
        padding: 10px; 
    }
</style>
<!-- Search form -->
<form action="{{ route('users.search') }}" method="GET">
    <input type="text" name="search" placeholder="Search...">
    <button type="submit">Search</button>
</form>
<div class="form-group">
    <label for="entries">Show Entries:</label>
    <select id="entries" name="entries">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
</div>


<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Username</th>
            <th>Valid ID</th>
            <th>Actions</th> <!-- Added a new column for actions -->
        </tr>
    </thead>
    <tbody>
        @foreach ($TbUserAcc as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->contact }}</td>
            <td>{{ $user->username }}</td>
            <td>
                <img src="{{ asset('storage/images/' . $user->image) }}"  width="50%" height="20%">
            </td>
            <td>
                <!-- Delete button -->
                <form action="{{ route('users.delete', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

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

<script>
$(document).ready(function () {
    $('#entries').change(function () {
        showEntries($(this).val());
    });

    function showEntries(entries) {
        $('#orders-table tbody tr').hide(); // Hide all rows
        $('#orders-table tbody tr:lt(' + entries + ')').show(); // Show only the first 'entries' number of rows
    }
});
</script>
