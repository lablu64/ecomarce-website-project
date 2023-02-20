@extends('admin.layouts.template')

@section('content')
    <div class="container my-6">
        <div class="card p-3">
            <div class="card-title">
                <h2 class="text-center">Pending Orders</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>User Id</th>
                        <th>Shoping Information</th>
                        <th>Product Id</th>
                        <th>Quantity</th>
                        <th>Total will Pay</th>
                        <th>action</th>
                    </tr>

                    @foreach($pending_orders as $order)
                    <tr>
                        <td>{{ $order->userid }}</td>
                        <td>
                            <li>Phone Number:{{ $order->shoping_phonNumber }}</li>
                            <li>City/vilage:{{ $order->shoping_city }}</li>
                            <li>Poster code:{{ $order->shoping_posterCode }}</li>

                        </td>
                        <td>{{$order->product_id }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->total_Price }}</td>
                        <td><a href="" class="btn btn-success"> Approve Now</a></td>
                    </tr>
                        
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

