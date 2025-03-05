@extends('admin-view.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @include('admin-view.left-sidebar')
        <div class="col-md-8">
            <div class="settings-header__table">

                <div class="settings-header__table">
                    <a href="/admin/settings/bank-accounts">
                        <button type="button" class="btn btn-default m-b">Bank Accounts</button>
                    </a>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <span class="table__drag-header">Method</span>
                            </th>
                            <th>Visible Name</th>
                            <th>Min</th>
                            <th>Max</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="methods-sortable">
                        @if(count($items))
                        @foreach($items as $key => $item)
                        <tr class="{{$item->method_type==2 ? '' : 'grey'}}" data-toggle="{{$item->id}}" data-id="{{$item->id}}">
                            <td>
                                <div class="table__drag handle">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>Drag-Handle</title>
                                        <path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                                    </svg>
                                </div>
                                {{$item->method_name}}
                            </td>
                            @php $method_extras = json_decode($item->method_extras); @endphp
                            <td>{{!empty($method_extras) ? $method_extras->name : ''}}</td>
                            <td>{{$item->method_min==0 ? '∞' : $item->method_min }}</td>
                            <td>{{$item->method_max==0 ? '∞' : $item->method_max }}</td>
                            <td> <input type="checkbox" class="tiny-toggle" data-tt-palette="blue" {{ $item->method_type==2 ? 'checked' : ''}} data-url="{{route('admin.payment-methods-type')}}" data-id="{{$item->id}}"> </td>
                            <td class="p-r">
                                <a class="btn btn-default btn-xs" href="{{route('admin.payment-methods.edit', $item->id)}}">Edit Content</a>
                                <button type="button" class="btn btn-default btn-xs pull-right edit-payment-method" data-toggle="modal" data-target="#modalDiv" data-action="edit_paymentmethod" data-id="{{$item->method_get}}">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade in" id="managerModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">MANAGER</h4>
                </div>
                <div class="modal-body" style="padding: 0px;">
                    <iframe src="/admin/manager" style="width:100%;height: 700px;border:none;overflow:hidden;"></iframe>
                </div>

            </div>

        </div>
    </div>

    @endsection