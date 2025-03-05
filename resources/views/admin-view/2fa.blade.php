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
        .two-factor {
            background: #d9edf6;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px
        }
        .error{
          color: red;
          margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="container container-fluid" role="main">

            <div class="col-sm-offset-4 col-sm-4 m-t">
                <div class="two-factor">
                    Your account is protected with two-factor <br>
                    authentication. <br>
                    We'we send you an email. Please check your inbox <br>
                    and enter the code below. <br>
                    Email: {{ @$email }}
                </div>
                <form action="{{ route('admin.postConfirm') }}" method="POST"
                    class="login100-form validate-form p-b-33 p-t-5">
                    @csrf
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="text-danger"> {{ $error }}</div>
                        @endforeach
                    @endif
                    @if (session('status'))
                        <div class="error" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter 8-digit code</label>
                        <input class="form-control" type="text" name="verify_code" id="verify_code"
                            placeholder="Enter 8-digit code" required autofocus />
                    </div>
                    @error('code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit" class="btn btn-default">Continue</button>
                </form>
            </div>
        </div>

    </div>
    <script src='https://www.google.com/recaptcha/api.js?hl=en'></script>

</body>
<html>
