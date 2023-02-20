@extends('user_temp.layouts.templete')
@section('page_title')
   checkout  pages
@endsection

@section('main-content')
<h1>Final Step to place you</h1>
@if(session()->has('message'))
<div class="alert-success">
  {{ session()->get('message') }}
</div>
  
@endif

<div class="row">
  <div class="col-6">
    <div class="box_main">
      <h3>product sent at -</h3>
      <p>City/Village : {{ $shiping_address->city_name }}</p>
      <p>Phone Number : {{ $shiping_address->phone_number }}</p>
      <p>Poster No    : {{ $shiping_address->poster_name }}</p>

    </div>
  </div>
  <div class="col-6">
    <div class="box_main">
     your final Product are -
    
          <div class="table-responsive">
              <table class="table">
                  <tr>
                      <th>Product Name</th>
                      <th>Prouduct Image</th>
                      <th> Quantity</th>
                      <th>Price</th>
                      
                    
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
                     
                  </tr>
                
                
                  @endif
                 
              </table>

         
      
  </div>
      
    </div>
  </div>
  <form action="{{ route('placeorder') }}" method="POST">
    @csrf
    <input type="submit" class="btn btn-primary" value="place order">
  </form>
    <form action="" method="POST">
      @csrf
    <input type="submit " class="btn btn-warning" style="margin-left: 15px;" value="chanced order">
  </form>
</div>

@endsection