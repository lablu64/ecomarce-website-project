@extends('admin.layouts.template')

@section('page_title')
    Edit Product Image
@endsection



@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">pages/</span> Edit  Product Image</h4>
    @if(session()->has('message'))
    <div class="alert-success">
      {{ session()->get('message') }}
    </div>
      
    @endif
    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Product Image</h5>
            <small class="text-muted float-end">Input Information</small>
          </div>
          <div class="card-body">
            <form action="{{ route('updateproductimg') }}" method="POST" enctype="multipart/form-data">
             @csrf
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Previous Image</label>
                <div class="col-sm-10">
                <img src="{{ asset($productinfo->product_img) }}" alt="">
                </div>
              </div>
             <input type="hidden" value="{{ $productinfo->id }}" name="id">
              
              <div class="mb-3">
                <label for="formFile" class="form-label"> New Upload  Image</label>
                <input class="form-control" type="file" name="product_img" id="product_img" />
              </div>
              
              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Update New Image</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / Content -->

@endsection
