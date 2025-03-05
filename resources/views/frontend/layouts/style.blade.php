@php $setting = Helpers::infoSetting();
 @endphp
<style>
  :root {
    --main-color: {{$setting->color}};

  }
  .body .component-navbar-balance-item__navbar-private{
    background: var(--main-color);
  }
  .body a{
    color: var(--main-color);
  }
  .btn-primary, .body .btn-big-primary, .body .btn-big-primary:hover, .page-item.active .page-link, #block_18 .component_button_submit .btn-big-primary, #block_18 .component_button_submit .btn-big-primary:hover{
    background-color:var(--main-color);
    border-color: var(--main-color);
  }
  .text-primary, .body .component-navbar-nav-link-active__navbar-public{
    color: var(--main-color) !important;
  }
  .body .component-sidebar{
    background: var(--main-color) !important;
  }
  .body .component-sidebar__menu-item-active .component-sidebar__menu-item-link{
    color: var(--main-color)
  }
  .form-check-custom.form-check-solid .form-check-input:checked{
    background-color: var(--main-color) !important
  }
  .body .component-navbar-nav-link__navbar-private:hover{
    color: var(--main-color)
  }
  .body a:hover{
    color: var(--main-color);
    opacity: 0.8;
  }
  .table-responsive .static td[colspan="5"]{
    color: #fff
  }
  
</style>