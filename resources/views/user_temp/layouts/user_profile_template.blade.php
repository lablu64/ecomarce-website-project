@extends('user_temp.layouts.templete')
@section('page_title')
   user profile pages
@endsection

@section('main-content')
<div class="container">
   <div class="row">
      <div class="col-lg-4 col-sm-4">
         <div class="box_main">
            <ul>
               <li><a href="{{ route('userprofile') }}"> Dashboard </a></li>
               <li><a href="{{ route('pendingorders') }}">Pending Order </a></li>
               <li><a href="{{ route('history') }}">History </a></li>
               <li><a href="#">Logout </a></li>
              
            </ul>

         </div>
      </div>
      <div class="col-lg-8 col-sm-4">
         <div class="box_main">
            @yield('userprofilecontent')
            
         </div>
      </div>
   </div>
</div>
@endsection