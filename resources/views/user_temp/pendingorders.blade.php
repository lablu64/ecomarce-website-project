@extends('user_temp.layouts.user_profile_template')

@section('userprofilecontent')

<h2>pending orders</h2>
@if(session()->has('message'))
<div class="alert-success">
  {{ session()->get('message') }}
</div> 
@endif

<div class="table-responsive">
    <table class="table">
        <tr>
            <th>Product Id</th>
            <th> Quantity</th>
            <th>Price</th>
            
          
        </tr>
         
        @foreach ($pending_orders as $order)
            <tr>
             
                <td>{{$order->product_id }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->total_Price }}</td>
               
            </tr>
           
        @endforeach
   
    </table>






@endsection