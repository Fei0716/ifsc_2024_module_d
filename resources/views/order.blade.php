@extends('layout.main')
@section('content')
    <h2>List of Registered Orders</h2>
    <table class="table table-dark table-striped table-responsive-md">
        <tr>
            <th>Order ID</th>
            <th>Company Name</th>
            <th>Courier Name</th>
            <th>Status</th>
        </tr>

        @foreach($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->company->name}}</td>
                <td>{{$order->courier_id != null ? $order->courier->name : 'Have not accepted by any courier'}}</td>
                <td>{{$order->status}}</td>
            </tr>
        @endforeach
    </table>
@endsection

