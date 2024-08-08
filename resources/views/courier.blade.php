@extends('layout.main')
@section('content')
    <h2>List of Couriers</h2>

    <table class="table table-dark table-striped table-responsive-md">
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Current Orders</th>
        </tr>
        @foreach($couriers as $courier)
            <tr>
                <td><a href="{{route('courier.show' , $courier)}}" class="text-white">{{$courier->name}}</a></td>
                <td>{{$courier->username}}</td>
                <td>
                    @if(count($courier->orders->where('status' , '!=' , 'delivered')) > 0)
                        @foreach($courier->orders->where('status' , '!=' , 'delivered') as $key => $order)
                            <ul class="list-group-item">
                                <li class="p-2"><strong>Company: </strong>{{$order->company->name}}</li>
                                <li class="p-2"><strong>Status: </strong>{{$order->status}}</li>
                                <li class="p-2"><strong>From: </strong>{{$order->destination_address}}</li>
                                <li class="p-2"><strong>To: </strong>{{$order->delivery_address}}</li>

                            </ul>
                        @endforeach
                    @else
                        <p>No orders accepted at the moment</p>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

@endsection

