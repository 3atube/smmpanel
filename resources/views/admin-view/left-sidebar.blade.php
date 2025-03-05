@php  $router = \Route::currentRouteName() @endphp
<div class="col-md-2 col-md-offset-1">
    <ul class="nav nav-pills nav-stacked p-b">
        <!-- <li class="settings_menus "><a href="/admin/settings/general">General</a></li> -->
        <li class="settings_menus {{$router=='admin.providers' ? 'active' : ''}}"><a href="/admin/settings/providers">Providers</a></li>
        <li class="settings_menus {{$router=='admin.payment-methods' ? 'active' : ''}}"><a href="/admin/settings/payment-methods">Payments Methods</a></li>
        <li class="settings_menus {{$router=='admin.languages' ? 'active' : ''}}"><a href="/admin/languages">Languages</a></li>
        <li class="settings_menus {{$router=='admin.notifications' ? 'active' : ''}}"><a href="/admin/notifications">Notifications</a></li>
        <li class="settings_menus {{$router=='admin.settings' ? 'active' : ''}}"><a href="/admin/settings">Settings</a></li>
    </ul>
</div>