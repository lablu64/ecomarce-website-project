@extends('user_temp.layouts.templete')
@section('page_title')
   add to cart pages
@endsection

@section('main-content')
 <h1>Product Card Item</h1>
 @if(session()->has('message'))
 <div class="alert-success">
   {{ session()->get('message') }}
 </div>
   
 @endif


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Product Name</th>
                        <th>Prouduct Image</th>
                        <th> Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                      
                    </tr>
                       @php 
                       $total=0;
                       @endphp
                    @foreach ($cart_items as $item)
                        <tr>
                            @php
                            $product_name = App\Models\Product:: where('id',$item->product_id)->value('product_name');
                            $img = App\Models\Product:: where('id',$item->product_id)->value('product_img');
                           
                           @endphp
                            <td>{{ $product_name }}</td>
                            <td><img style="height:100px;" src="{{ asset($img) }}" alt=""></td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <a href="{{ route('removecarditem',$item->id) }}" class="btn btn-warning"> Remove</a>
                            </td>
                        </tr>
                        @php 
                        $total= $total + $item->price;
                        @endphp  
                    @endforeach
                    @if($total > 0)
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td> {{ $total }}</td>
                        <br>
                       <td><a class="btn btn-primary" href="{{ route('shippingaddress') }}"> Checkout Now</a></td>
                       
                    </tr>
                  
                  
                    @endif
                   
                </table>

            </div>
        </div>
    </div>
</div>
@endsection