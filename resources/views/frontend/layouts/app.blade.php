@if(Auth::check())
@include('frontend.layouts.header-login')
@else
@include('frontend.layouts.header')
@endif
@yield('content')
@if(Auth::check())
@include('frontend.layouts.footer-login')
@else
@include('frontend.layouts.footer')
@endif

