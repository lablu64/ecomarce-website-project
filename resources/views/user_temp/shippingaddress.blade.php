@extends('user_temp.layouts.templete')
@section('page_title')
   add to cart pages
@endsection

@section('main-content')
<h2>Private Shipping Information </h2>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <form action="{{ route('addshippingaddress') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="city_name">City/Village</label>
                        <input type="text" name="city_name" id="city_name">
                    </div>
                    <div class="form-group">
                        <label for="poster_name">Poster Code</label>
                        <input type="number" name="poster_name" id="poster_name">
                    </div>
                  <input type="submit" class="btn btn-primary" value="Next">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection