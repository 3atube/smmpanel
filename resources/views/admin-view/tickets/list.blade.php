@extends('admin-view.layouts.app')

@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs">
        <li class="p-b"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDiv" data-action="new_ticket">Create New Support Request</button></li>
        <li class="pull-right custom-search">
            <form class="form-inline" action="" method="get">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="Search Request...">
                    <span class="input-group-btn search-select-wrap">
                        <select class="form-control search-select" name="search_type">
                            <option value="subject" {{request()->search_type =='subject' ? 'selected' : ''}}>SUBJECT</option>
                            <option value="client" {{request()->search_type =='client' ? 'selected' : ''}}>USERNAME</option>
                        </select>
                        <button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
                    </span>
                </div>
            </form>
        </li>
        <li class="pull-right export-li">
            @if(request()->search=='unread')
            <a href="/admin/tickets" class="export">
                <span class="export-title">Show all of them</span>
            </a>

            @else
            <a href="/admin/tickets?search=unread" class="export">
                <span class="export-title">Show Unread</span>
            </a>
            @endif
        </li>
    </ul>
    <table class="table">
        <thead>
            <tr>
                <th class="checkAll-th">
                    <div class="checkAll-holder">
                        <input type="checkbox" id="checkAll">
                        <input type="hidden" id="checkAllText" value="order">
                    </div>
                    <div class="action-block">
                        <ul class="action-list">
                            <li><span class="countOrders"></span> request selected</li>
                            <li>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Bulk Operations<span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="bulkorder" data-type="unread">Make All Unread</a>
                                            <a class="bulkorder" data-type="readed">Make All Read</a>
                                            <a class="bulkorder" data-type="lock">Lock All</a>
                                            <a class="bulkorder" data-type="unlock">Unlock All</a>
                                            <a class="bulkorder" data-type="close">Close All</a>
                                            <a class="bulkorder" data-type="pending">Put All On Hold</a>
                                            <a class="bulkorder" data-type="answered">Make All Answered</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </th>
                <th width="5%" class="p-l">ID</th>
                <th width="15%">Username</th>
                <th width="50%">Subject</th>
                <th width="10%" class="dropdown-th">
                    <div class="dropdown">
                        <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Status <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li class="active"><a href="/admin/tickets">All</a></li>
                            <li><a href="/admin/tickets?status=pending">Pending</a></li>
                            <li><a href="/admin/tickets?status=answered">Answered</a></li>
                            <li><a href="/admin/tickets?status=closed">Closed</a></li>
                        </ul>
                    </div>
                </th>
                <th width="10%">Creation Date</th>
                <th width="10%" nowrap="">Last Updated</th>
                <th></th>
            </tr>
        </thead>
        <form id="changebulkForm" action="/admin/tickets/multi-action" method="post"></form>
        <tbody>
            @if(!empty($items))
            @foreach($items as $item)
            <tr>
                <td><input type="checkbox" class="selectOrder" name="ticket[{{$item->id}}]" value="{{$item->id}}" style="border:1px solid #fff"></td>
                <td class="p-l">{{$item->id}}</td>
                <td>{{$item->user ? $item->user->name : ""}}</td>
                <td class="subject">{!!$item->canmessage==1?'<i class="fa fa-lock"></i> ':''!!}<a href="{{route('admin.tickets-read',[$item->id])}}">{!!$item->client_new==2 ? '<b>'.$item->subject.'</b>' : $item->subject!!}</a></td>
                <td style="    text-transform: capitalize;">{{$item->status}}</td>
                <td nowrap="">{{$item->created_at}}</td>
                <td nowrap="">{{$item->updated_at}}</td>
                <td class="service-block__action">
                    <div class="dropdown pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Transactions <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="{{route($item->client_new==1 ? 'admin.tickets-unread' : 'admin.tickets-read-new',[$item->id])}}">{{$item->client_new==1 ? 'Make Unread' : 'Make Read'}}</a></li>
                            <li><a href="{{route($item->canmessage==2 ? 'admin.tickets-lock' : 'admin.tickets-unlock',[$item->id])}}">{{$item->canmessage==2 ? 'Lock' : 'UnLock'}}</a></li>
                            @if($item->status!='closed')
                            <li><a href="{{route('admin.tickets-close',[$item->id])}}">Close Request</a></li>
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
        @php $links = $items->withQueryString()->links('pagination::bootstrap-4') @endphp
            {!!\App\Libraries\Helpers::pagiSearch($links, '/admin/tickets')!!}
        <input type="hidden" name="bulkStatus" id="bulkStatus" value="0">

    </table>
</div>

@endsection