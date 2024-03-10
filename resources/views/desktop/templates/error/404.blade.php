@extends('desktop.master')

@section('content')
<div class="my-5 container-error">
    <div class="error-left">404</div>
    <div class="error-right">
      <h3 class="error-title">This page or post does not exist or you entered the wrong address</h3>
      <p class="error-info">Please check the website link again</p>
      <div class="error-slogan">Enter the keyword you want to search here!</div>
      <p class="error_btn"><a href="{{route('home')}}">Go back to the main page</a></p>
    </div>
</div>
@endsection

@push('css_page')
  <style>   
   .container-error{display: flex;max-width: var(--content-width);margin: auto;align-items: center;}
   .error-left{font-weight: bold;color: var(--color-page);font-size: 250px;}
   .error-title{font-weight: bold;}
   .error-info{margin: 1rem 0;color: #999;}
   .error-slogan{font-weight: bold;display: none;}
   .error-right{padding-left: 3rem;}
   .error_btn{margin-top: 20px;}
   .error_btn a{display: inline-block;background:var(--color-page);color:#fff;padding:8px 20px;text-decoration: none;border-radius: 30px;font-weight: bold;}

   @media screen and (max-width: 650px){
    .container-error{flex-wrap: wrap;justify-content: center;}
   }
</style>
@endpush