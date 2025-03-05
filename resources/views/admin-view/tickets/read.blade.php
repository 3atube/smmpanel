@extends('admin-view.layouts.app')

@section('content')<div class="container container-md">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs"> <a href="/admin/tickets" class="details_backButton btn btn-link"><span>‹</span> Back To Tickets</a>
                <li class="pull-right custom-search">
                    <form class="form-inline" action="/admin/orders" method="get" target="_blank">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" value="" placeholder="Order ID">
                            <span class="input-group-btn search-select-wrap">
                                <select class="form-control search-select" name="search_type">
                                    <option value="order_id">ID</option>
                                </select>
                                <button type="submit" class="btn btn-default"><span class="fa fa-search" aria-hidden="true"></span></button>
                            </span>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="ticket-header__title border-radius-top">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ticket-header-title">
                            {{$info->subject}} <span class="service-block__provider-value"> <i class="fa fa-eye-slash"></i> Not Seen Yet</span>
                            @if($info->canmessage==1)<span class="badge"><i class="fa fa-lock"></i> Support request is locked, User cannot reply.</span>@endif
                            <div class="ticket-header-id">ID: {{$info->id}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="ticket-header__textarea">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('admin.tickets-post-read', [$info->id])}}"  enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="ticket-message-submit">
                                            <textarea name="message" id="" cols="30" rows="5" class="form-control ticket-edit__textarea"></textarea>
                                        </div>
                                    </div>
                                    @if($errors->has('message')) <div class="error">{{ $errors->first('message') }}</div>
                                    @endif
                                    <div class="form-group">
                                        <span id="btn-select-img" class="fileUpload a1 btn update-img-profile upl-image-pf">
                                            <input accept="image/*" type="file" class="upload up" name="file" />
                                        </span>
                                    </div>
                                    @if($errors->has('file')) <div class="error" style="color: red; margin-bottom: 10px">{{ $errors->first('file') }}</div>
                                    @endif
                                    <input name="username" value="cheapestsmmscript" hidden="">
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary" type="submit">
                                            Submit Answer </button>
                                        <div class="btn-group">
                                            <a href="{{route('admin.tickets-close', $info->id)}}" class="btn btn-default" data-toggle="modal">
                                                Close Request </a>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li> <a href="/admin/tickets/lock/1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Destek talebini kilitle">Lock And Close Request</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-sm-6 ticket-header__unread">
                                    <a href="{{route('admin.tickets-unread', $info->id)}}" class="btn btn-link ticket-btn__unread">
                                        Mark as Unread </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="ticket-body">
                        <div class="ticket-message__container">
                            @if(count($items))
                            @foreach($items as $item)
                            @if($item->support==2)
                            <div class="ticket-message__block ticket-message__support">
                                <div class="ticket-message">
                                    <div class="ticket-message__title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="ticket-message__title-date">
                                                    {{$item->created_at}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-message__text">{!!$item->message!!}</div>
                                    <div class="image">
                                        <img src="{{$item->image}}" alt="">
                                    </div>
                                </div>

                                <a data-toggle="modal" data-target="#modalDiv" data-action="edit_ticket" data-id="{{$item->id}}">Edit</a> • <a href="#" data-toggle="modal" data-target="#confirmChange" data-href="{{route('admin.tickets-reply-delete',[$item->id])}}">Delete</a>

                            </div>
                            @endif
                            @if($item->support==1)
                            <div class="ticket-message__block ticket-message__client">
                                <div class="ticket-message">
                                    <div class="ticket-message__title">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <strong>{{$item->user ? $item->user->name : ""}}</strong>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="ticket-message__title-date">
                                                    {{$item->created_at}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-message__text">{!!$item->message!!}

                                    </div>
                                    <div class="image">
                                        <img src="{{$item->image}}" alt="">
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif



                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>Do You Confirm the Transaction?</h4>
                <div align="center">
                    <a class="btn btn-primary" href="" id="confirmYes">Yes</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .image{
        margin: 10px 0
    }
    .image img{
        width: 100%;
    }
</style>
@endsection