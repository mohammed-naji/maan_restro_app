@extends('layouts.master')
@section('main')
    <div class="d-flex justify-content-between align-items-center mt-2">

        <h1 class="h2">Orders Page</h1>

        <a class="btn btn-primary px-5" href="{{ route('orders.create') }}"><i class="fas fa-add"></i> Create New</a>
    </div>


    <table class="table table-bordered mt-4">
        <tr>
            <th>ID</th>
            <th>Total</th>
            <th>Meals</th>
            <th>Invoice Number</th>
            <th>Deliver To</th>
            <th>status</th>
            <th>Order Type</th>
            <th>User</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>

        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->total }}$</td>
                <td>
                    <ul>
                    @foreach ($order->meals as $meal)
                        <li>{{ $meal->name }} - {{ $meal->items->quantity }}</li>
                    @endforeach
                </ul>
                </td>
                <td>{{ $order->invoice_no }}</td>
                <td>{{ $order->deliver_to }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->order_type }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    <form class="d-inline" method="POST" action="{{ route('orders.destroy', $order->id) }}">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Are You Sure ي اخونا')" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach


    </table>
@stop
