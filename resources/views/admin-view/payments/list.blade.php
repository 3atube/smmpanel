@extends('admin-view.layouts.app')
@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs">
        <li class="p-b">
            <button class="btn btn-default" data-toggle="modal" data-target="#modalDiv" data-action="payment_new">
                <span class="export-title">Add/Remove Balance</span>
            </button>
        </li>

        <li class="pull-right custom-search">
            <form class="form-inline" action="/admin/payments" method="get">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="Search for payment...">
                    <span class="input-group-btn search-select-wrap">
                        <select class="form-control search-select" name="search_type">
                            <option value="username">USERNAME</option>
                        </select>
                        <button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
                    </span>
                </div>
            </form>
        </li>
        <li class="pull-right export-li">
            <a href="/admin/payments/bank" class="export">
                <span class="export-title"> Bank Payment Notifications</span>
            </a>
        </li>
    </ul>
    <table class="table">
        <thead>
            <tr>
                <th class="p-l">ID</th>
                <th>User</th>
                <th>Old Balance</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Mode</th>
                <th>Note</th>
                <th>Creation Date</th>
                <th>Issue Date</th>
                <th></th>
            </tr>
        </thead>
        <form id="changebulkForm" action="/admin/payments/online/multi-action" method="post"></form>
        <tbody>
            @if(count($items))
            @foreach($items as $item)
            <tr>
                <td class="p-l">{{$item->id}}</td>
                <td>{{!empty($item->user) ? $item->user->name : ''}}</td>
                <td>{{$item->user_balance}}</td>
                <td>{{$item->payment_amount}}</td>
                <td>{{!empty($item->payment_methods) ? $item->payment_methods->method_name : ''}}</td>
                <td>
                @php $payment_status = $item->payment_status @endphp 
                @if($payment_status==3)   
                Complete
                @elseif($payment_status==2)
                Cancel
                @else
                Pending
                @endif
                </td>
                <td>{{$item->payment_mode}}</td>
                <td>{{$item->payment_note}}</td>
                <td nowrap="">{{$item->created_at}}</td>
                <td nowrap="">{{$item->updated_at}}</td>
                <td class="service-block__action">
                    <div class="dropdown pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Transactions <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="payment_edit" data-id="{{$item->id}}">Edit</a></li>
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
        {!!\App\Libraries\Helpers::pagiSearch($links, '/admin/payments')!!}
          
        <input type="hidden" name="bulkStatus" id="bulkStatus" value="0">

    </table>
</div>
@endsection