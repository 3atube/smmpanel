
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>

<title>Admin</title>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
<script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
<![endif]-->  
<base href='{{asset("/")}}'>

<meta name="csrf-token" content="{{ csrf_token() }}">
<link href='{{asset("admin-view/css/admin/custom.css")}}?time={{time()}}' rel='stylesheet'>
<link rel='stylesheet' href='{{asset("admin-view/css/admin/bootstrap.css")}}'>
<link rel='stylesheet' href='{{asset("admin-view/css/admin/style.css")}}'>
<link rel='stylesheet' href='{{asset("admin-view/css/admin/toastDemo.css")}}'>
<link rel='stylesheet' href='{{asset("admin-view/js/datepicker/css/bootstrap-datepicker3.min.css")}}'>
<link rel='stylesheet' href='{{asset("admin-view/css/admin/tinytoggle.min.css")}}' rel='stylesheet'>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css'>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">



</head>
<body class=''>
<nav  class='navbar navbar-fixed-top navbar-default'>
<div class='container-fluid'>
<div class='navbar-header'>
<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-navbar-collapse'>
<span class='sr-only'>Toggle navigation</span>
<span class='icon-bar'></span>
<span class='icon-bar'></span>
<span class='icon-bar'></span>
</button>
</div>
<div class='collapse navbar-collapse' data-nav='navbar-priority' id='bs-navbar-collapse'>
<ul id='navResponsive' class='nav navbar-nav navbar-left-block'>
@php    $router = \Route::currentRouteName() @endphp
<li class="{{$router=='admin.users' ? 'active' : ''}}"><a href='/admin/users'>Users</a></li>

<li class="{{$router=='admin.clients' ? 'active' : ''}}"><a href='/admin/clients'>Clients</a></li>
<li class="{{$router=='admin.orders' ? 'active' : ''}}"><a href='/admin/orders'>Orders</a></li>
@php $countRefill = \App\Libraries\Helpers::countTasks() @endphp
<li class="{{$router=='admin.refill' ? 'active' : ''}}"><a href="{{route('admin.tasks')}}">Refill/Partial @if($countRefill)<span class="badge" style="background-color: #6d47bb">{{$countRefill}}</span>@endif </a></li>
<li class="{{$router=='admin.services' ? 'active' : ''}}"><a href='/admin/services'>Services</a></li>
  
<li class="{{$router=='admin.payments' ? 'active' : ''}}"><a href='/admin/payments'> Payments </a></li>
<li class="{{$router=='admin.logs' ? 'active' : ''}}"><a href='{{route('admin.logs')}}'> Logs </a></li>

<li class="{{$router=='admin.reports.orders' ? 'active' : ''}}"><a href='{{route('admin.reports.orders', 'orders')}}'> Reports </a></li>


   @php $countTicket = \App\Libraries\Helpers::countUnreadTicket() @endphp
<li class="{{$router=='admin.tickets' ? 'active' : ''}}"><a href='/admin/tickets'>Tickets @if($countTicket)<span class="badge" style="background-color: #6d47bb">{{$countTicket}}</span>@endif </a></li>

<!-- <li class="{{$router=='admin.providers' ? 'active' : ''}}"><a href='/admin/reports'>REPORTS</a></li>  -->
          
<!-- <li class="{{$router=='admin.providers' ? 'active' : ''}}"><a href='/admin/appearance'>APPEARANCE</a></li>  -->

<li class="{{$router=='admin.providers' || $router=='admin.payment-methods' || $router== 'admin.bank-accounts' ? 'active' : ''}}"><a href='/admin/settings/providers'>Settings</a></li>

<!-- <li class="{{$router=='admin.providers' ? 'active' : ''}}"><a href='/admin/logs'>LOGS </a></li>  -->

</ul>  
<ul id='w4' class='nav navbar-nav navbar-right'>
<li><a href='#' data-toggle='modal' data-target='#managerModal'><img src='https://i.imgur.com/D8QmgSY.png' width='20' height='20'></a></li><li class='nav-dark-mode'><a href='/admin?theme=2&refer=clients'><i class='fa fa-moon'></i></a></li>
<li class=''><a href='/admin/account'>ACCOUNT</a></li>      
<li><a href="{{route('admin.logout')}}">LOGOUT </a></li></ul>        
</div>
</div>
</nav>