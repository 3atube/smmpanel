@extends('frontend.login.app')
@section('content')
<div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto div-signup">
                        <!--begin::Form-->
                        <form class="form-horizontal" method="POST" action="{{ route('postRegisterCustomer') }}">
                {{ csrf_field() }} 
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-3">Create an Account</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-400 fw-bold fs-4">Already have an account? 
                                <a href="{{ route('user.login') }}" class="link-primary fw-bolder">Sign in here</a></div>
                                <!--end::Link-->
                            </div>
                            <div class="fv-row mb-5">
                                <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                                <input class="form-control form-control-lg form-control-solid username" name="name" value=""
                        required="" autofocus="" autocomplete="off" autocorrect="off" autocapitalize="off"
                        spellcheck="false" minlength="4" maxlength="50" type="text">
                            </div>
                             @if ($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
                @endif
                            <div class="fv-row mb-5">
                                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                <input class="form-control form-control-lg form-control-solid email" id="email" name="email"
                        value="" required="" type="text">
                            </div>
                            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
                @endif
                            <div class="fv-row mb-5">
                                <label class="form-label fw-bolder text-dark fs-6">Password</label>
                                <input class="form-control form-control-lg form-control-solid password" id="password" name="password"
                        required="" autocomplete="new-password" minlength="8" type="password">
                            </div>
                            @if ($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
                @endif
                            <div class="fv-row mb-5">
                                <label class="form-label fw-bolder text-dark fs-6">Confirm password</label>
                                <input class="form-control form-control-lg form-control-solid confpass" 
                        id="password_confirmation" name="password_confirmation" required="" minlength="8" type="password">
                            </div>
                            @if ($errors->has('password_confirmation'))
                <div class="error">{{ $errors->first('password_confirmation') }}</div>
                @endif
                            <div class="text-center">
                                <button type="submit" class="btn btn-lg btn-primary w-100 mb-5" >
                                    <span class="indicator-label">Submit</span>
                                </button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
@endsection