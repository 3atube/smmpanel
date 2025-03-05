
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>App Mua Like</title>
  <meta name="description" content="App Mua Like - Dịch vụ mạng xã hội uy tín #1">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://app.mualike.net/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://app.mualike.net/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://app.mualike.net/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://app.mualike.net/css/app.css?v=0806">
  <link rel="icon" href="https://app.mualike.net/images/favicon.png" />
  <link rel="apple-touch-icon" href="https://app.mualike.net/images/favicon.png" />
  <meta name="msapplication-TileImage" content="https://app.mualike.net/images/favicon.png" />
  <meta property="og:image" content="https://app.mualike.net/images/apptanglike.png" />
  <meta property="og:image:width" content="1024" />
  <meta property="og:image:height" content="681" />
  <meta name="google-site-verification" content="a0vgRI0CfVPvGD7dFCJRx4ZsaF0OW4zT5Hv6KCdtpBQ" />
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-THWJ4HC');</script>
<!-- End Google Tag Manager -->
</head>
<body class="hold-transition login-page">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THWJ4HC"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) --><div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="https://app.mualike.net" class="h1"><img style="max-width: 88%" src="https://app.mualike.net/images/apptanglike-logo.png"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg pb-3">Vui lòng đăng nhập để sử dụng dịch vụ</p>
      
        <!-- Validation Errors -->
              <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}     <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Tên người dùng hoặc Email" id="name" name="name" value="" required autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control"
                        placeholder="Mật khẩu"
                        name="password"
                        required autocomplete="current-password" />
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
                <input id="remember" type="checkbox" name="remember">
                <label for="remember">
                Nhớ tài khoản
              </label>
            </div>
          </div>
        </div>
        <div class="social-auth-links text-center mt-2 mb-3">
          <button class="btn btn-block btn-primary">
            Đăng Nhập
          </button>
        </div>
      </form>
      <!-- /.social-auth-links -->
      <div class="row">
        <div class="col-6">
          <a href="https://app.mualike.net/forgot-password">Quên mật khẩu ?</a>
        </div>
        <div class="col-6 text-right">
          <a href="https://app.mualike.net/register" class="text-center">Đăng ký</a>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://app.mualike.net/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://app.mualike.net/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://app.mualike.net/dist/js/adminlte.js"></script>

</body>
</html>