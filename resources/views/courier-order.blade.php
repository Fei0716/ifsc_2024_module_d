@extends('layout.main')
@section('content')
    <h2>List of Orders for Courier <br>({{$courier->username}})</h2>

    <table class="table table-dark table-striped table-responsive-md">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Current Orders</th>
        </tr>
        <tr>
            <td>{{$courier->name}}</td>
            <td>{{$courier->username}}</td>
            <td>
                @if(count($courier->orders) > 0)
                    @foreach($courier->orders as $key => $order)
                        <h3>Order ID: {{$order->id}}</h3>
                        <ul class="list-group-item mb-4">
                            <li class="p-2"><strong>Company: </strong>{{$order->company->name}}</li>
                            <li class="p-2"><strong>Status: </strong>{{$order->status}}</li>
                            <li class="p-2"><strong>From: </strong>{{$order->destination_address}}</li>
                            <li class="p-2"><strong>To: </strong>{{$order->delivery_address}}</li>
                        </ul>
                    @endforeach
                @else
                    <p>No orders accepted by this courier</p>
                @endif
            </td>
        </tr>
    </table>

@endsection

