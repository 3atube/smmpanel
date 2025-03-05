@extends('admin-view.layouts.app')
@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs p-b">
        @php $current = URL::current() @endphp
        <li class="{{\Route::currentRouteName()=='admin.orders' ? 'active' :''}}"><a href="/admin/orders">All Orders</a>
        </li>
        <li class="{{strpos($current, '/cronpending') !== false ? 'active' : ''}}"><a href="/admin/orders/1/cronpending">Cron Pending <span class="badge" style="background-color: #808080"></span></a></li>
        <li class="{{strpos($current, '/pending') !== false ? 'active' : ''}}"><a href="/admin/orders/1/pending">Pending</a></li>
        <li class="{{strpos($current, 'processing') !== false ? 'active' : ''}}"><a href="/admin/orders/1/processing">
            @php $countProcessing = \App\Libraries\Helpers::countOrderStatus('processing') @endphp
            @if($countProcessing)<span class="badge" style="background-color: #8b3a3a">{{$countProcessing}}</span>@endif Processing</a></li>
        <li class="{{strpos($current, 'inprogress') !== false ? 'active' : ''}}"><a href="/admin/orders/1/inprogress">InProgress</a></li>
        <li class="{{strpos($current, 'completed') !== false ? 'active' : ''}}"><a href="/admin/orders/1/completed">Completed</a></li>
        <li class="{{strpos($current, 'partial') !== false ? 'active' : ''}}"><a href="/admin/orders/1/partial">Partial</a></li>
        <li class="{{strpos($current, 'canceled') !== false ? 'active' : ''}}"><a href="/admin/orders/1/canceled">Canceled</a></li>
        @php $countOrder = \App\Libraries\Helpers::countOrderStatus('fail') @endphp
        <li class="{{strpos($current, 'fail') !== false ? 'active' : ''}}"><a href="/admin/orders/1/fail">Fail
                @if($countOrder)<span class="badge" style="background-color: #8b3a3a">{{$countOrder}}</span>@endif</a>
        </li>
        <li class="pull-right custom-search">
            <form class="form-inline" action="/admin/orders" method="get">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="Search orders...">
                    <span class="input-group-btn search-select-wrap">
                        <select class="form-control search-select" name="search_type">
                            @php $arr = ['order_id' => 'ID', 'order_url' => 'Link', 'username' => 'Username'] @endphp
                            @foreach($arr as $key => $value)
                            <option value="{{$key}}" {{request()->search_type==$key ? 'selected' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
                    </span>
                </div>
            </form>
        </li>
    </ul>
    <table class="table order-table table-grey">
        <thead>
            <tr>
                <th class="checkAll-th">
                    <div class="checkAll-holder">
                        <input type="checkbox" id="checkAll">
                        <input type="hidden" id="checkAllText" value="order">
                    </div>
                    <div class="action-block">
                        <ul class="action-list">
                            <li><span class="countOrders"></span> order selected</li>
                            <li>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Bulk Operations <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        @php $statusList = ["all","pending","inprogress","completed","partial","canceled","processing","fail","cronpending"];
                                        $status = $string;
                                        @endphp
                                        @if($string == 'pending' || $string == 'inprogress' || $string == 'processing' || $string == 'fail')
                                        <li>
                                            <a class="bulkorder" data-type="pending">Pending</a>
                                        </li>
                                        <li>
                                            <a class="bulkorder" data-type="inprogress">In Progress</a>
                                        </li>
                                        <li>
                                            <a class="bulkorder" data-type="processing">Processing</a>
                                        </li>
                                        <li>
                                            <a class="bulkorder" data-type="completed">Completed</a>
                                        </li>
                                        <li>
                                            <a class="bulkorder" data-type="canceled">Canceled</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </th>
                <th>ID</th>
                <th>Username</th>
                <th>Charge</th>
                <th>Link</th>
                <th>Start</th>
                <th>Quantity</th>
                <th class="dropdown-th">
                    <div class="dropdown">
                        <button class="btn btn-th btn-default dropdown-toggle" data-active="" type="button" id="serviceList" data-href="admin/orders/counter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Service
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="serviceListContent" style="max-height: 275px; overflow:hidden; overflow-y: scroll">
                        </ul>
                    </div>
                </th>
                <th>Order Status</th>
                <th>Remaining</th>
                <th>Order Date</th>
                <th width="10%" class="dropdown-th">
                    <div class="dropdown">
                        <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Mode
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li class="active"><a href="/admin/orders">all</a></li>
                            <li class=""><a href="/admin/orders?mode=manuel">Manuel</a></li>
                            <li class=""><a href="/admin/orders?mode=auto">Automatic</a></li>
                        </ul>
                    </div>
                </th>
                <th></th>
            </tr>
        </thead>
        <form id="changebulkForm" action="/admin/orders/multi-action" method="post">
            @csrf
            <tbody>
                @if(count($items))
                @foreach( $items as $item )
                <tr>
                    <td><input type="checkbox" class="selectOrder" name="order[{{$item->id}}]" value="1" style="border:1px solid #fff"></td>
                    <td class="p-l">
                        {{$item->id}}
                        @if($item->api_orderid!=0)
                        <div class="service-block__provider-value">{{$item->api_orderid}}</div>
                        @endif
                    </td>
                    <td>{{$item->user ? $item->user->name : null}}
                        @if($item->order_where=='api')
                        <span class="label label-api">API</span>
                        @endif
                    </td>
                    <td class="service-block__minorder">
                        <div>
                            {{$item->order_charge}}
                        </div>
                        @if($item->service_api!=0)
                        <div class="service-block__provider-value">{{$item->order_profit}}</div>
                        @endif
                    </td>
                    <td>{{$item->order_url}}
                        @if( !empty($item->order_extras) || $item->order_extras != "[]")
                        <a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalDiv" data-action="order_comment" data-id="{{$item->id}}">Comments</a>
                        @endif
                    </td>
                    <td>{{$item->order_start}}</td>
                    <td>{{$item->order_quantity}}</td>
                    <td> @if($item->service_id)<span class="label-id">{{$item->service_id}}</span>@endif
                        {{$item->service_name}}
                    </td>
                    <td>{{\App\Libraries\Helpers::getStatusOrder($item->order_status)}}</td>
                    <td>
                        @if( $item->order_status == "completed" && substr($item->order_remains, 0,1) == "-" ))
                        {{"+".substr($item->order_remains, 1)}}
                        @else
                        {{$item->order_remains}}
                        @endif
                    </td>
                    <td>{{ \App\Libraries\Helpers::timeCurrent($item->order_create, $item->user->time_zone)  }}</td>
                    <td>
                        @if($item->api_serviceid==0)
                        Manuel
                        @else
                        Auto
                        @endif
                    </td>
                    <td class="service-block__action">
                        <div class="dropdown pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown" aria-expanded="false">Transactions <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="details" data-id="{{$item->id}}">Details</a></li>
                                @if($item->order_error != "-" && @$item->service->service_api != 0)
                                <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="order_errors" data-id="{{$item->id}}">Faild Detail</a></li>
                                <li><a href="{{route('admin.orders.order-resend',$item->id)}}">Resend order</a></li>
                                @endif
                                @if($item->order_error == "-" && $item->service_api != 0 )
                                <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="order_details" data-id="{{$item->id}}">Order Detail</a></li>
                                @endif
                                @if($item->service_api == 0 || $item->order_error != "-" )
                                <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="order_orderurl" data-id="{{$item->id}}">Edit Order Link</a></li>
                                @endif
                                @if( $item->service_api == 0)
                                <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="order_startcount" data-id="{{$item->id}}">Start count</a>
                                </li>
                                @endif
                                @if($item->order_status != "partial")
                                <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="order_partial" data-id="{{$item->id}}">Set partial</a></li>
                                @endif
                                <li class="dropdown dropdown-submenu">
                                    <a class="dropdown_menu">Change Order Status</a>
                                    <ul class="dropdown-menu submenu_drop">
                                        @if($item->order_status == "pending" || $item->order_status == "inprogress" ||
                                        $item->order_status == "completed" || $item->order_status == "processing" ||
                                        $item->order_status == "partial" || $item->order_status == "fail")
                                        <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="{{route('admin.orders.cancel',$item->id)}}">Cancel and
                                                Refund</a></li>
                                        @endif
                                        @if($item->order_status == "pending" || $item->order_status == "inprogress" ||
                                        $item->order_status == "processing" || $item->order_status == "fail")
                                        <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="{{route('admin.orders.complete',$item->id)}}">Completed</a>
                                        </li>
                                        @endif
                                        @if($item->order_status == "pending" || $item->order_status == "processing")
                                        <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="{{route('admin.orders.inprogress',$item->id)}}">Loading</a>
                                        </li>
                                        @endif
                                        @if($item->order_status == "fail" || $item->order_status == "processing")
                                        <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="{{route('admin.orders.pending',$item->id)}}">Pending</a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="12">Chưa có dữ liệu</td>
                </tr>
                @endif
            </tbody>
            @php $links = $items->withQueryString()->links('pagination::bootstrap-4') @endphp
            <input type="hidden" name="bulkStatus" id="bulkStatus" value="0">
            {!!@$links!!}
        </form>
    </table>
    {!!@$links!!}
</div>
<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>Do you approve the transaction?</h4>
                <div align="center">
                    <a class="btn btn-primary" href="" id="confirmYes">YES</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection