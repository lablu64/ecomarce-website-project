@extends('user_temp.layouts.templete')
@section('page_title')
   single product pages
@endsection

@section('main-content')
<main class="main">
   <div class="page-header breadcrumb-wrap">
       <h2>Product Details</h2>
   </div>
   <section class="mt-50 mb-50">
       <div class="container">
           <div class="row">
               <div class="col-lg-9">
                   <div class="product-detail accordion-detail">
                       <div class="row mb-50">
                           <div class="col-md-6 col-sm-12 col-xs-12">
                               <div class="detail-gallery">
                                   <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                   <!-- MAIN SLIDES -->
                                   <div class="product-image-slider">
                                       <figure class="border-radius-10">
                                           <img src="{{ asset($product->product_img) }}" alt="product image">
                                       </figure>
                                      
                                   </div>
                                 
                               </div>
                              
                             
                           </div>
                           <div class="col-md-6 col-sm-12 col-xs-12">
                               <div class="detail-info">
                                   <h2 class="title-detail">{{ $product->product_name }}</h2>
                                   <div class="product-detail-rating">
                                   </div>
                                   <div class="clearfix product-price-cover">
                                       <div class="product-price primary-color float-left">
                                           <ins><span class="text-brand">${{ $product->price }}</span></ins>
                                           <ins><span class="old-price font-md ml-15">$200.00</span></ins>
                                           <span class="save-price  font-md color3 ml-15">25% Off</span>
                                       </div>
                                   </div>
                                   <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                   <div class="short-desc mb-30">
                                    {{ $product->product_short_des }}
                                   </div>
                                   <div class="product_sort_info font-xs mb-30">
                                       <ul>
                                           <li class="mb-10"><i class="fi-rs-crown mr-5"></i> 1 Year AL Jazeera Brand Warranty</li>
                                           <li class="mb-10"><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
                                           <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                                       </ul>
                                   </div>

                                   <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                   <div class="detail-extralink">
                                       
                                       <ul class="product-meta font-xs color-grey mt-50">
                                          <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                          <li class="mb-5">Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">Women</a>, <a href="#" rel="tag">Dress</a> </li>
                                          <li>Availability:<span class="in-stock text-success ml-5">{{ $product->quantity }}</span></li>
                                      </ul>
                                       <div class="product-extra-link2">
                                        <form action="{{ route('addproducttocard') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                                            <input type="hidden" value="{{ $product->price }}" name="price">
                                            <input type="hidden" value="1" name="quantity">
                                           <label for="quantity"> How are many pices?</label>
                                            <input class="form-control" type="number" min=1 placeholder="1" name="quantity" >
                                            <button type="submit" value="Add to Cart" class="button button-add-to-cart">Add to cart</button>
                                        </form>
                                            </div>
                                   </div>
                                  
                               </div>
                               <!-- Detail Info -->
                           </div>
                       </div>
                       <div class="tab-style3">
                           <ul class="nav nav-tabs text-uppercase">
                               <li class="nav-item">
                                   <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                               </li>
                               <li class="nav-item">
                                   <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                               </li>
                               <li class="nav-item">
                                   <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                               </li>
                           </ul>
                           <div class="tab-content shop_info_tab entry-main-content">
                               <div class="tab-pane fade show active" id="Description">
                                   <div class="">
                                    {{ $product->product_long_des }}
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row mt-60">
                           <div class="col-12">
                               <h3 class="section-title style-1 mb-30">Related products</h3>
                           </div>
                           <div class="col-12">
                              <div class="row">
                                 @foreach ($related_products as $product)
                                    <div class="col-lg-4 col-sm-4">
                                       <div class="box_main">
                                          <h4 class="shirt_text">{{ $product->product_name }}</h4>
                                          <p class="price_text">Price  <span style="color: #262626;">$ {{ $product->price }}</span></p>
                                          <div class="tshirt_img"><img src="{{ asset($product->product_img) }}"></div>
                                          <div class="btn_main">
                                             <div class="buy_bt">
                                                 <form action="{{ route('addproducttocard') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                    <input type="hidden" value="{{ $product->price }}" name="price">
                                                    <input type="hidden" value="1" name="quantity">
                                                        <button type="submit" value="Add to Cart" class="button button-add-to-cart">Buy now</button>
                                                </form>
                                             </div>
                                             <div class="seemore_bt"><a href="{{ route('sigleproduct',[$product->id ,$product->slug]) }}">See More</a></div>
                                          </div>
                                       </div>
                                    </div>
                                  @endforeach 
                               </div>
                           </div>
                       </div>                            
                       
                   </div>
               </div>
               <div class="col-lg-3 primary-sidebar sticky-sidebar">
                   <div class="widget-category mb-30">
                       <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                       <ul class="categories">
                        @php
                        $categories = App\Models\Category::latest()->get();
                        @endphp

                        @foreach ($categories as $category )
                        <li><a href="{{ route('categorypages',[$category->id,$category->slug]) }}">{{ $category->category_name }}</a></li>
                        @endforeach
                       
                          
                       
                       </ul>
                   </div>
                  
                   <!-- Product sidebar Widget -->
                                        
               </div>
           </div>
       </div>
   </section>
</main>

@endsection