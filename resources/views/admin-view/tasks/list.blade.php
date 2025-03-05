@extends('admin-view.layouts.app')

@section('content')<div class="container-fluid">
    @if(session('refill'))
<div class="alert alert-danger ">{!!session('refill')!!}</div>
@endif
    <ul class="nav nav-tabs p-b">
        <li class=""><a href="{{route('admin.tasks')}}">All</a></li>
        <li class=""><a href="{{route('admin.tasks', ['task_status' => 'canceled'])}}">Canceled</a></li>
        <li class=""><a href="{{route('admin.tasks', ['task_status' => 'pending'])}}">Pending</a></li>
        <li class="pull-right custom-search">
            <form class="form-inline" action="/admin/tasks" method="get">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="" placeholder="Search task..." />
                    <span class="input-group-btn search-select-wrap">
                        <select class="form-control search-select" name="search_type">
                            <option value="order_id">Order ID</option>
                        </select>
                        <button type="submit" class="btn btn-default">
                            <span class="fa fa-search" aria-hidden="true"></span>
                        </button>
                    </span>
                </div>
            </form>
        </li>
    </ul>
    <table class="table">
        <thead>
            <tr><th class="checkAll-th">
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
                                        <li>
                                            {{-- <a class="bulkorder" data-type="reject">Reject</a> --}}
                                            <a class="bulkorder" data-type="refill">Refill</a>
                                        </li>
                                </div>
                            </li>
                        </ul>
                    </div>
                </th>
                <th>Task ID</th>
                <th>Order ID</th>
                <th>User</th>
                <th>Details</th>
                <th>Link</th>
                <th>start</th>
                <th>Quantity</th>
                <th>Request</th>
                <th>Task Status</th>
                <th class="dropdown-th"></th>
            </tr>
        </thead>
        <form id="changebulkForm" action="/admin/tasks/multi-action" method="post">
            @csrf
        @if(!empty($items))

        <tbody>
            @foreach($items as $item)
            <tr>
            <td>
                @if($item->task_status != 'canceled')
                <input type="checkbox" class="selectOrder" name="task[{{$item->id}}]" value="1" style="border:1px solid #fff">
                @endif
            </td>
                <td class="p-l">
                {{$item->id}}
                    <div class="service-block__provider-value"></div>
                </td>
                <td>
                {{$item->order_id}}
                    <div class="service-block__provider-value"></div>
                </td>
                <td>{{$item->user ?$item->user->name : ''}}</td>
                <td>{!!$item->details!!}</td>
                <td>
                   {{$item->order ?$item->order->order_url : ''}}
                </td>
                <td>{{$item->order ?$item->order->order_start : ''}}</td>
                <td>{{$item->order ?$item->order->order_quantity : ''}}</td>
                <td class="text">{{$item->type}} <br> {{ \App\Libraries\Helpers::timeCurrent($item->created_at)  }}</td>
                <td>{{\App\Libraries\Helpers::getStatusTask($item->task_status)}}</td>
                <td></td>
                <td class="service-block__action">
                    <div class="dropdown pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown" {{$item->task_status!='pending' ? 'disabled=""' : ''}} >
                            Transactions <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{route('admin.tasks.no', $item->id)}}">Reject</a>
                            </li>
                            @if($item->task_type==2)
                            <li>
                                <a href="{{route('admin.tasks.success', $item->id)}}">Approve</a>
                            </li>
                            <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="{{route('admin.tasks.refill', $item->id)}}">Refill</a></li>
                            @elseif($item->task_type==1)
                            <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="{{route('admin.tasks.canceled', $item->id)}}">Cancel and refund</a></li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="8">Chưa có dữ liệu</td>
            </tr>
        @endif
        </tbody>
        <input type="hidden" name="bulkStatus" id="bulkStatus" value="0" />
        </form>
        @php $links = $items->withQueryString()->links('pagination::bootstrap-4') @endphp
        {!!$links!!}
    </table>
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
<style>
    .text{
        text-transform: capitalize;
    }
</style>
@endsection