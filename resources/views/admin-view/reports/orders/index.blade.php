@extends('admin-view.layouts.app')
@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
    $(function () {
    $('.selectpicker').selectpicker();
});
</script>
<style>
    .selectpicker_service-group .dropdown-menu.open{
        width: 300px !important;
    }
</style>
@endsection
@section('content')
<div class="container-fluid main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="report-navs">
                <!-- Left navs Start -->
                <div class="report-navs__left">
                    <ul class="nav nav-tabs p-b">
                        <li class="active">
                            <a href="{{route('admin.reports.orders', ['orders'])}}">
                                Orders </a>
                        </li>
                    </ul>
                </div>
                <!-- Left navs End -->
                <!-- Right navs Start -->
                <form id="report-form" action="{{route('admin.reports.orders', [$string])}}" method="post">
                    @csrf
                    <div class="report-navs__right">
                        <div class="report-navs__block">
                            <div class="btn-group" role="group">
                                @php
                                $arr = ['orders', 'quantity'];    
                                @endphp
                                @foreach($arr as $item)
                                <a href="{{route('admin.reports.orders', [$item, 'year'=> $year])}}" class="btn btn-default {{$string == $item ? 'active' : ''}}">Total
                                    {{$item}}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="report-navs__block">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    {{$year}}
                                     <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    @for($i = \Carbon\Carbon::now()->subYear()->year; $i <= \Carbon\Carbon::now()->year; $i++)
                                    <li class="{{request()->year == $i ? 'active' : ''}}">
                                        <a href="{{route('admin.reports.orders', [$string, 'year'=> $i])}}" >{{$i}}</a>
                                    </li>
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        <div class="report-navs__block">
                            <select name="users[]" id="ajax-select-multiple" class="selectpicker with-ajax" data-live-search="true"
                            data-actions-box="true" data-users="1" multiple data-title="All Users">
                                @foreach($users as $item)
                                <option value="{{$item->id}}" {{in_array($item->id, @$usersWhere) ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="report-navs__block selectpicker_service selectpicker_service-group" >
                            <select class="selectpicker" name="services[]" data-live-search="true"
                                data-actions-box="true" multiple data-title="All services">
                                @foreach($services as $item)
                                <option value="{{$item->id}}" {{in_array($item->id, @$servicesWhere) ? 'selected' : ''}}>{{$item->service_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="report-navs__block report-navs__block-status">
                            <select class="selectpicker" name="statuses[]" multiple data-max-options="100"
                                data-size="10" data-title="Status">
                                @php
                                $array = [
                                    'pending' => 'Pending',
                                    'processing' => 'Processing',
                                    'inprogress' => 'In progress',
                                    'completed' => 'Completed', 
                                    'partial' => 'Partial',
                                    'canceled' => 'Canceled',
                                    'fail' => 'Fail'
                                ]
                                @endphp
                                @foreach($array as $key => $item)
                                <option value="{{$key}}" {{in_array($key, @$statusesWhere) ? 'selected' : ''}}>{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="report-navs__block">
                            <button type="submit" class="btn btn-primary">
                                Submit </button>
                        </div>
                    </div>
                </form> <!-- Right navs End -->
            </div>
        </div>
    </div>
    @php $month = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] @endphp
    <div id="table_orders_reports">

        <div class="row">
            <div class="col-md-12">
                <table class="table report-table">
                    <thead>
                        <tr>
                            <th>
                                &nbsp;
                            </th>
                            @foreach($month as $item)
                            <th>
                                {{$item}} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 1; $i<=31; $i++)
                        <tr>
                            <td>{{$i}}</td>
                            @foreach($month as $key => $item)
                            <td>{!!Helpers::getTotalByDate($year, $key + 1, $i, $string, $servicesWhere, $usersWhere, $statusesWhere )!!}</td>
                            @endforeach
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection