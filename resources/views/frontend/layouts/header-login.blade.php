<!DOCTYPE html>
<html id="theme_21" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>New order</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="google-site-verification" content="" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    {{-- <link href="/assets/client/1/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> --}}

    {{-- <link href="/assets/client/1/plugins/global/plugins.dark.bundle.css" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="/assets/client/1/css/style.dark.bundle.css" rel="stylesheet" type="text/css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{asset('front-end/css/style1.css')}}"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{asset('front-end/css/style2.css')}}"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.12/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="/assets/client/1/js/scripts.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@include('frontend.layouts.style')
<script>
  var TIME_ZONE = {{Auth::user()->time_zone}},
            USER = {{Auth::user()->id}};
</script>
@php     $router = \Route::currentRouteName() @endphp
<style>
  .wrap{
    width: 300px;
  }
  .report.fw-bold{
    margin-left: 10px
  }
  .fa-clock{
    margin-left: 10px
  }
  .bg-lighten{
    cursor: pointer;
  }
  .page-link{
    border: none
  }
  .page-item{
    margin-right: 0.5rem;
  }
  .table-responsive{
    overflow: hidden;
  }
.component_service_description {
    padding-top: 12px;
    padding-left: 12px;
    padding-right: 16px;
    padding-bottom: 16px;
    border-color: #C3DAEB;
    background: #F1F7FC;
    font-size: "";
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
    border-left-width: 0px;
    border-right-width: 0px;
    border-top-width: 0px;
    border-bottom-width: 2px;
    border-style: solid;
    box-shadow: none;
}
:root {
  --kt-form-check-input-checked-bg-color-solid: #009ef7;
  --kt-dropdown-box-shadow: 0px 0px 50px 0px rgba(82, 63, 105, 0.15);
  --kt-form-check-label-color: #565674;
  --kt-form-check-label-color-checked: #92929f;
  --kt-form-switch-checked-bg-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23ffffff'/%3e%3c/svg%3e");
  --kt-dropdown-bg: #ffffff;
  --kt-component-hover-bg: #F4F6FA;
  --kt-component-hover-color: #009ef7;
  --kt-form-switch-bg-image-solid: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23A1A5B7'/%3e%3c/svg%3e");
}
  .form-check-custom {
    display: flex;
    align-items: center;
    padding-left: 0;
    margin: 0;
}
.select2-container--bootstrap5 .select2-dropdown .select2-results__option {
    transition: color .2s ease;
    padding: 0.75rem 1.25rem;
    margin: 0;
}
.select2-container--bootstrap5 .select2-dropdown .select2-results__option.select2-results__option--selected {
  background-color: #78889b;
    color: #fff;
    transition: color .2s ease;
    position: relative;
}
.form-check-custom .form-check-label, .form-check-label {
    margin-left: 4.55rem;
}
.form-switch.form-check-solid .form-check-input:checked {
    filter: none;
    background-image: var(--kt-form-switch-checked-bg-image);
}
.form-check-custom.form-check-solid .form-check-input:checked {
    background-color: var(--kt-form-check-input-checked-bg-color-solid);
}
.form-check-label {
    color: var(--kt-form-check-label-color);
}

.select2-container--bootstrap5 .select2-dropdown {
    border: 0;
    box-shadow: var(--kt-dropdown-box-shadow);
    border-radius: 0.65rem;
    padding: 1rem 0;
    background-color: #f1f7fc;
}
.form-switch.form-check-solid .form-check-input {
  height: 2.25rem;
  background-image: var(--kt-form-switch-bg-image-solid);
  border-radius: 3.25rem;
}
.form-switch.form-check-solid .form-check-input:checked {
  filter: none;
  background-image: var(--kt-form-switch-checked-bg-image);
}
.form-switch.form-check-solid.form-switch-sm .form-check-input {
  height: 1.5rem;
  width: 2.5rem;
}
.form-check-custom .form-check-input {
    margin: 0;
    float: none;
    flex-shrink: 0;
}
.form-switch .form-check-input {
    width: 3.25rem;
    background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIHZpZXdCb3g9Jy00IC00IDggOCc+PGNpcmNsZSByPSczJyBmaWxsPSdyZ2JhKDAsIDAsIDAsIDAuMjUpJy8+PC9zdmc+);
    background-position: left center;
    border-radius: 3.25rem;
    transition: background-position .15s ease-in-out;
}
.form-check-input {
    width: 1.75rem;
    height: 1.75rem;
    margin-top: -0.125rem;
    vertical-align: top;
    background-color: transparent;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: 1px solid #e4e6ef;
    appearance: none;
    print-color-adjust: exact;
}
.form-switch.form-check-solid.form-switch-lg .form-check-input {
  height: 2.75rem;
  width: 3.75rem;
}
  .tr-hidden {
      visibility: collapse;
  }
  a.btn.btn-primary.btn-sm.px-3.py-2 {
      color: #fff;
  }
  .blockui .blockui-overlay {
    transition: all .3s ease;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0,0,0,.05);
}
.bg-opacity-25 {
    background-color: rgba(var(--bg-color),.25)!important;
}
.blockui .blockui-message {
    display: flex;
    align-items: center;
    border-radius: 0.65rem;
    box-shadow: 0 0 30px rgba(0,0,0,.3);
    background-color: #2b2b40;
    color: #92929f;
    font-weight: 500;
    margin: 0!important;
    width: auto;
    padding: 0.85rem 1.75rem!important;
}
</style>
  </head>
  <body class="body">
    <div class="wrapper wrapper-sidebar-navbar">
      <div id="block_24" class="component_private_navbar">
        <span class="component_private_navbar">
          <div class="component-navbar-private__wrapper">
            <div
              class="sidebar-block__top component-navbar component-navbar__navbar-private editor__component-wrapper"
            >
              <div>
                <nav class="navbar navbar-expand-lg navbar-light">
                  <div class="sidebar-block__top-brand">
                    <div
                      class="component-navbar-brand component-navbar-public-brand"
                    >
                      <a target="_self" href="/"
                        ><span style="text-transform: uppercase"
                          ><span style="font-size: 24px"
                            ><span style="letter-spacing: 1px"
                              ><span style="line-height: 48px"
                                ><strong style="font-weight: bold"
                                  >{{request()->getHost()}}</strong
                                ></span
                              ></span
                            ></span
                          ></span
                        ></a
                      >
                    </div>
                  </div>
                  <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbar-collapse-24"
                    aria-controls="navbar-collapse-24"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                  >
                    <span class="navbar-burger">
                      <span class="navbar-burger-line"></span>
                    </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbar-collapse-24">
                    <div class="component-navbar-collapse-divider"></div>
                    <div class="d-flex component-navbar-collapse">
                      <ul class="navbar-nav navbar-nav-sidebar-menu">
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                          <a
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private component-navbar-nav-link-active__navbar-private"
                            href="/"
                          >
                            New order
                          </a>
                        </li>
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                          <a
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private"
                            href="/services"
                          >
                            Services
                          </a>
                        </li>
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                          <a
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private"
                            href="/cashflow"
                          >
                          Cashflow
                          </a>
                        </li>
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                          <a
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private"
                            href="/orders"
                          >
                            Orders
                          </a>
                        </li>
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                          <a
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private"
                            href="/addfunds"
                          >
                            Add funds
                          </a>
                        </li>
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                          <a
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private"
                            href="/api"
                          >
                            API
                          </a>
                        </li>
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                          <a
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private"
                            href="/massorder"
                          >
                            Mass order
                          </a>
                        </li>
                      </ul>
                  </ul>
                      <ul class="navbar-nav navbar-nav-currencies">
                        <li
                          class="nav-item d-flex align-items-center component-navbar-nav-item component-navbar-private-nav-item component-navbar-balance-wrap__navbar-private"
                        >
                          <a
                            class="component-navbar-balance-item__navbar-private"
                            >${{AUth::user()->balance}}</a
                          >
                        </li>
                      </ul>
                      <ul class="navbar-nav">
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                          <a
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private"
                            href="/account"
                            >Account</a
                          >
                        </li>
                        <li
                          class="nav-item component-navbar-nav-item component-navbar-private-nav-item"
                        >
                        <form method="post" action="{{route('logout')}}" style="
                        height: 100%;
                    ">
                          {{ csrf_field() }}
                          <button style="
                          border: none;
                      "
                            class="component-navbar-nav-link component-navbar-nav-link__navbar-private"
                            >Logout</button
                          >
                        </form>
                          
                        </li>
                      </ul>
                    </div>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </span>
        <span class="component_private_sidebar">
          <div class="component-sidebar_wrapper">
            <div
              class="sidebar-block__left component-sidebar component-sidebar-with-navbar editor__component-wrapper component_private_navbar"
            >
              <div class="component-sidebar__menu-logo">
                <div
                  class="component-navbar-brand component-sidebar__menu-brand"
                >
                  <a target="_self" href="/"
                    ><span style="text-transform: uppercase"
                      ><span style="font-size: 24px"
                        ><span style="letter-spacing: 1px"
                          ><span style="line-height: 48px"
                            ><strong style="font-weight: bold"
                              >{{request()->getHost()}}</strong
                            ></span
                          ></span
                        ></span
                      ></span
                    ></a
                  >
                </div>
              </div>
              <ul class="component-sidebar__menu sidebar-block__left-menu">
                <li
                  class="component-sidebar__menu-item {{ $router == 'index'? 'component-sidebar__menu-item-active' : ''}}"
                >
                  <a class="component-sidebar__menu-item-link" href="{{route('index')}}">
                    New order
                  </a>
                </li>
                <li class="component-sidebar__menu-item {{ $router == 'home.services'? 'component-sidebar__menu-item-active' : ''}}">
                  <a class="component-sidebar__menu-item-link" href="{{route('home.services')}}">
                    Services
                  </a>
                </li>
                <li class="component-sidebar__menu-item {{ $router == 'orders'? 'component-sidebar__menu-item-active' : ''}}">
                  <a class="component-sidebar__menu-item-link" href="{{route('orders')}}">
                    Orders
                  </a>
                </li>
                <li class="component-sidebar__menu-item {{ $router == 'cashflow'? 'component-sidebar__menu-item-active' : ''}}">
                  <a class="component-sidebar__menu-item-link" href="{{route('cashflow')}}">
                    Cashflow
                  </a>
                </li>
                <li class="component-sidebar__menu-item {{ $router == 'addfunds'? 'component-sidebar__menu-item-active' : ''}}">
                  <a class="component-sidebar__menu-item-link" href="{{route('addfunds')}}">
                    Add funds
                  </a>
                </li>
                <li class="component-sidebar__menu-item {{ $router == 'home.api'? 'component-sidebar__menu-item-active' : ''}}">
                  <a class="component-sidebar__menu-item-link" href="{{route('home.api')}}">
                    API
                  </a>
                </li>
                <li class="component-sidebar__menu-item {{ $router == 'massorder'? 'component-sidebar__menu-item-active' : ''}}">
                  <a
                    class="component-sidebar__menu-item-link"
                    href="{{route('massorder')}}"
                  >
                    Mass order
                  </a>
                </li>
                <li class="component-sidebar__menu-item {{ $router == 'account.messages' ||  $router == 'account.view-ticket'? 'component-sidebar__menu-item-active' : ''}}">
                  <a
                    class="component-sidebar__menu-item-link"
                    href="{{route('account.messages')}}"
                  >
                Tickets
                </a>
              </li>
              </ul>
            </div>
          </div>
        </span>
      </div>
      <div class="wrapper-content">
        <div class="wrapper-content__header"></div>
        <div class="wrapper-content__body">
          <!-- Main variables *content* -->
          