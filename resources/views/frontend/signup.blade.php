@extends('frontend.layouts.app')
@section('scriptFooter')
    <script>
        typeof _api !== 'undefined' && _api.init();
    </script>
    <script type="text/javascript"  src="https://www.google.com/recaptcha/api.js?hl=en" >
    </script>
@endsection
@section('content')
    <div id="block_23">
        <div class="sign-in">
            <div class="bg"></div>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
            <div class="container">
                <div class="row sign-up-center-alignment">
                    <div class="col-lg-8">
                        <div class="component_card">
                            <div class="card">
                              <form class="form-horizontal" method="POST" action="{{ route('postRegisterCustomer') }}">
                                {{ csrf_field() }} 
                                    <div>
                                        @if (count($errors) > 0)
                                            @foreach ($errors->all() as $error)
                                                <div class="text-danger"> {{ $error }}</div>
                                            @endforeach
                                        @endif
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="login" class="control-label">Username</label>
                                                    <input type="text" class="form-control" name="name" value=""
                                                    required="" autofocus="" autocomplete="off" autocorrect="off" autocapitalize="off"
                                                    spellcheck="false" minlength="4" maxlength="50" type="text">
                                                </div>
                                            </div>
                                            @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="email" class="control-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                    value="" required="" type="text">
                                                </div>
                                            </div>
                                            @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="password" class="control-label">Password</label>
                                                    <input type="password" class="form-control"  id="password" name="password"
                                                    required="" autocomplete="new-password" minlength="8" type="password">
                                                </div>
                                            </div>
                                            @if ($errors->has('password'))
                                            <div class="error">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                        <div class="component_form_group">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="password_again" class="control-label">Confirm
                                                        password</label>
                                                    <input type="password" class="form-control" 
                                                    id="password_confirmation" name="password_confirmation" required="" minlength="8" type="password">
                                                </div>
                                            </div>
                                            @if ($errors->has('password_confirmation'))
                                            <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                            @endif
                                        </div>
                                        
                                    </div>

                                    <div class="component_button_submit">
                                        <div class="form-group">
                                            <div class="">
                                                <button type="submit" class="btn btn-block btn-big-primary">Sign
                                                    up</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="g-recaptcha form-group" data-sitekey="{{env('NOCAPTCHA_SITEKEY')}}"></div>
                                    <div class="text-center">Already have an account?<a href="/"
                                            class="sign-up-center-signin-link">Sign in</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
