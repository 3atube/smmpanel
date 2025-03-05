<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env("APP_NAME", "Admin")}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='{{ asset('admin-view/css/admin/custom.css') }}' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .error {
            color: red;
            margin-bottom: 10px
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="container container-fluid" role="main">
            <div class="col-sm-offset-4 col-sm-4 m-t">
                <form action="{{ route('admin.login') }}" method="POST"
                    class="login100-form validate-form p-b-33 p-t-5">
                    @csrf
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="text-danger"> {{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username or Email</label>
                        <input class="form-control" type="text" name="email" id="email"
                            placeholder="Username or Email" required autofocus />
                    </div>
                    @if ($errors->has('email'))
                        <span class="error" role="alert">{{ $errors->first('email') }}
                    @endif

                    <div class="form-group">
                        <label for="exampleInputPassword1">PASSWORD</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password"
                            id="password" name="password" placeholder="Password" required
                            autocomplete="current-password" maxlength="300" />
                    </div>
                    @if ($errors->has('password'))
                        <span class="error" role="alert">{{ $errors->first('password') }}
                    @endif
                    @if (session('status'))
                        <div class="error" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="g-recaptcha form-group" data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"></div>

                    <button type="submit" class="btn btn-default">LOGIN</button>
                </form>
            </div>
        </div>

    </div>
    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>

</body>
<html>
