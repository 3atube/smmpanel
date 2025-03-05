<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign in</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="shortcut icon" type="image/ico" href="https://cdn.mypanel.link/246i0o/l9c87arysb60oqad.ico" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<style>
    .integration-fixed {
        position: fixed;
        z-index: 10000000
    }

    .integration-fixed__top-left {
        top: 0;
        left: 0
    }

    .integration-fixed__top-right {
        top: 0;
        right: 0
    }

    .integration-fixed__bottom-left {
        bottom: 0;
        left: 0
    }

    .integration-fixed__bottom-right {
        bottom: 0;
        right: 0
    }
</style>



<link rel="stylesheet" type="text/css" href="{{ asset('front-end/all/246i0o/rlw4d3e7ya40i714.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('front-end/all/global/pfhorm61ru14utfk.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('front-end/all/libs/bootstrap-datetimepicker/4.17.47/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('front-end/all/global/29sz1jwqs2y1tscl.css') }}">
</head>

<body>
    <nav class="navbar navbar-default navbar-static-top ">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/" style="text-transform: uppercase">
                    {{ request()->getHost() }}
                </a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="/">
                            <i class="navbar-icon fas fa-sign-in-alt"></i>
                            Sign in
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home.signup') }}">
                            <i class="navbar-icon fas fa-user-plus"></i>
                            Sign up
                        </a>
                    </li>
                    <li>
                        <a href="/services">
                            <i class="navbar-icon fas fa-list"></i>
                            Services
                        </a>
                    </li>
                    <li>
                        <a href="/api">
                            <i class="navbar-icon far fa-file-code"></i>
                            API
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main variables *content* -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="well">
                    <form class="form-horizontal" method="POST" action="{{ route('loginCustomerAction') }}">
                        {{ csrf_field() }}

                        @if (session('status'))
                            <div class="error" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                        </div>
                        @if ($errors->has('name'))
                            <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                        <div class="form-group form-group__password">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" class="form-control" id="password" value="{{ old('password') }}"
                                name="password">
                        </div>
                        @if ($errors->has('password'))
                            <div class="error">{{ $errors->first('password') }}</div>
                        @endif
                        <button type="submit" class="btn btn-primary">Sign in</button>

                        <span class="pull-right pull-right-middle">Do not have an account? <a
                                href="{{ route('home.signup') }}">Sign
                                up</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="well ">
                    <p style="text-align: center; ">
                        <font color="#ff0000">WELCOME TO {{ env('APP_NAME') }}</font>
                    </p>
                    <p style="text-align: center; ">⚠️ EXCLUSIVE ON {{ env('APP_NAME') }} (PROMOTION) category actived.
                    </p>
                    <p style="text-align: center; ">We Have 24x7 Whatsapp Support Team&nbsp;☑️</p>
                    <p
                        style="text-align: justify; font-weight: 700; vertical-align: middle; margin-left: 4px; max-height: 38px; overflow: hidden; display: flex; align-items: center;">
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; THREADS | Followers | Likes | Comments |
                        Reshares category actived.</p>
                </div>
            </div>
        </div>
    </div>



    @include('frontend.layouts.style')

    <style>
        .whatsapp-container {
            padding: 24px
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .whatsapp-button {
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF !important;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            transition: all 0.3s ease;
            transform: scale(0.9)
        }

        .whatsapp-button:hover {
            transform: scale(1);
            background-color: #1fcc5f
        }
    </style>
</body>

</html>
