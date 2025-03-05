@extends('frontend.login.app')
@section('content')
<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto div-signin">
    <!--begin::Form-->
    <form class="form-horizontal" method="POST" action="{{ route('loginCustomerAction') }}">
        {{ csrf_field() }}
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">Sign In</h1>
            <!--end::Title-->
            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">New Here?
                <a href="{{ route('registerCustomer') }}" class="link-primary fw-bolder">Create an Account</a>
            </div>
            <!--end::Link-->
        </div>
        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bolder text-dark">Username</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid username" id="name" name="name" value="{{ old('name') }}" type="text" />
            <!--end::Input-->
        </div>
        @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
        @endif
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                <!--end::Label-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid password" value="{{ old('password') }}" name="password" type="password" />
            <!--end::Input-->
        </div>
        @if($errors->has('password'))
        <div class="error">{{ $errors->first('password') }}</div>
        @endif
        @if(session('status'))
        <div class="error" role="alert">
            {{session('status')}}
        </div>
        @endif
        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                <span class="indicator-label">Sign In</span>
            </button>
            <!--end::Submit button-->
        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->
    <!--end::Wrapper-->
</div>
<style>
    .error {
        color: red;
    }
</style>
@endsection