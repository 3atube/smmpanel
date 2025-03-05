@extends('admin-view.layouts.app')
@section('scripts')
<script src="https://www.jqueryscript.net/demo/select-color-palettes/jquery.kolorpicker.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/select-color-palettes/style/kolorpicker.css" type="text/css" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            @include('admin-view.left-sidebar')
            <div class="col-md-8">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{ route('admin.post.settings') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            {{-- <div class="form-group">
                                <label class="control-label">Panel Name</label>
                                <input type="text" class="form-control" name="name" value="MagicPi">
                            </div> --}}
                            <div class="form-group">
                                <label class="control-label">Color Default</label> <span style="background: {!!$info->color!!}; width: 30px; height: 30px;     display: inline-block;"></span>
                                <br>
                                <input type="text" class="form-control kolorPicker" name="color" value="{!!$info->color!!}">
                            </div>

                           <div class="form-group">
                                <label class="control-label">Layout</label>
                                <select class="form-control" name="layout">
                                    @for($i = 1; $i < 6; $i++)
                                    <option value="layout{{$i}}" <?php if('layout'.$i == $info->layout){ echo "selected"; } ?>>Layout{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Channel</label>
                                <input class="form-control" name="channel_post" value="{{$info->channel_post}}">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Token Telegram</label>
                                <input class="form-control" name="token_telegram" value="{{$info->token_telegram}}">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="control-label">Header Code Field (Visible on All Pages) <span
                                        class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"></span></label>
                                <textarea class="form-control" rows="7" name="custom_banner" >{!!$info->custom_banner!!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Footer Code Field (Visible on All Pages) <span class="fa fa-info-circle"
                                        data-toggle="tooltip" data-placement="top"></span></label>
                                <textarea class="form-control" rows="7" name="custom_buy" >{!!$info->custom_buy!!}</textarea>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
