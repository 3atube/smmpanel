@extends('admin-view.layouts.app')
@section('content')
<div class="container-fluid">

    <ul class="nav nav-tabs">
        <li class="active"><a href="/admin/payments/bank">All payments</a></li>
        <!-- <li class=""><a href="/admin/payments/bank/1/pending">Pending Payments</a></li> -->
        <!-- <li class=""><a href="/admin/payments/bank/1/completed">Confirmed Payments</a></li> -->
        <!-- <li class=""><a href="/admin/payments/bank/1/canceled">Canceled Payments</a></li> -->
        <li class="pull-right custom-search">
            <form class="form-inline" action="/admin/payments/bank" method="get">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="" placeholder="Search..">
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
            <a href="/admin/payments" class="export">
                <span class="export-title">Online Payments</span>
            </a>
        </li>
        <li class="pull-right export-li">
            <button class="btn btn-default" data-toggle="modal" data-target="#modalDiv" data-action="payment_banknew">
                <span class="export-title">Add Payment</span>
            </button>
        </li>
    </ul>
    <table class="table">
        <thead>
            <tr>
                <th class="p-l">ID</th>
                <th>User</th>
                <th>Amount</th>
                <th>Bank</th>
                <th>Status</th>
                <th>Note</th>
                <th>Creation Date</th>
                <th>Issue date</th>
                <th></th>
            </tr>
        </thead>
        <form id="changebulkForm" action="/admin/payments/bank/multi-action" method="post"></form>
        <tbody>
            @if(count($items)>0)
            @foreach($items as $item)
            <tr>
                <td class="p-l">{{$item->id}}</td>
                <td>{{$item->user ? $item->user->name : ''}}</td>
                <td>{{$item->payment_amount}}</td>
                <td>{{!empty($item->payment_banks) ? $item->payment_banks->bank_content : ''}}</td>
                <td>approved</td>
                <td>{{$item->payment_note}}</td>
                <td nowrap="">{{$item->created_at}}</td>
                <td nowrap="">{{$item->updated_at}}</td>
                <td class="service-block__action">
                    <div class="dropdown pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Transactions <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#" data-toggle="modal" data-target="#modalDiv" data-action="payment_bankedit" data-id="{{$item->id}}">Edit</a></li>
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
        <input type="hidden" name="bulkStatus" id="bulkStatus" value="0">

    </table>
</div>
@endsection