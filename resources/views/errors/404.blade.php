@extends('template')

@section('main')
<style>
  .header_area .navbar {
    display: none;
}
.footer-bg {
    display: none;
    scroll 
}
body {
  overflow-y: hidden; /* Hide vertical scrollbar */
  overflow-x: hidden; /* Hide horizontal scrollbar */
}

</style>
    <div class="container-fluid container-fluid-90 min-height margin-top-85 mb-5">
      <div class="error_width " >
        <div class="notfound position-center">
            <div class="notfound-404">
              <h2>Coming Soon</h2>
              <img src="{{asset('front/images/logos/logo.jpg')}}"  alt="logo" style="width: 200px;height: 200px;">
            </div>
            {{-- <h2 class="text-center">{{trans('messages.error.error_data_1')}}  {{trans('messages.error.error_data_2')}}</h2> --}}
          </div>
      </div>
    </div>  
@stop
