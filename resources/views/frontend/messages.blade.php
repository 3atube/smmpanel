@extends('frontend.layouts.app')

@section('content')
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">

        <div class="card mb-5 mb-xl-10 div-order">
            <!--begin::Body-->
            <div class="card-body">
                @if(session('success_tickers'))
                <span class="label-count" style="color: green; font-size: 20px">{{ session('success_tickers')}}</span>
                @endif
                @if(session('error_max'))
                <span class="label-count" style="color: red; font-size: 20px">{{ session('error_max')}}</span>
                @endif

                <form method="post" enctype="multipart/form-data" action="{{route('account.ticket-send')}}" id="ticketsend">
                    @csrf
                    <div class="alert alert-dismissible alert-danger ticket-danger " style="display: none">
                        <button type="button" class="close">×</button>
                        <div></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="subject" class="control-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject">
                    </div>
                    @if($errors->has('subject'))
                    <div class="error">{{ $errors->first('subject') }}</div>
                    @endif
                    <br>
                    <div class="form-group">
                        <label for="message" class="control-label">Message</label>
                        <textarea class="form-control" rows="7" id="message" name="message"></textarea>
                    </div>
                    @if($errors->has('message'))
                    <div class="error">{{ $errors->first('message') }}</div>
                    @endif
                    <div class="form-group">
                        <span id="btn-select-img" class="fileUpload a1 btn update-img-profile upl-image-pf">
                            <input accept="image/*" type="file" class="upload up" name="file" />
                        </span>
                    </div>
                    @if($errors->has('file')) <div class="error" style="color: red; margin-bottom: 10px">{{ $errors->first('file') }}</div>
                    @endif
                    <br>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
                <!--begin::Nav-->
                <br><br>
                <!--end::Tab Content-->
                @if(count($items)>0)
                <div class="well">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th class="nowrap">Last update</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)

                            <tr>
                                <td>{{$item->id}}</td>
                                <td><a class="{{$item->support_new==2 ? 'bold' : 'not-bold'}}" href="{{route('account.view-ticket',[$item->id])}}">{{$item->subject}}</a></td>
                                <td class="status-message">{{$item->status}}</td>
                                <td><span class="nowrap">{{$item->created_at}}</span></td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                @endif
                @if($max>=3 && 1==2)
                <div class="well1 ">
                    <h2 style="font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; color: rgb(0, 0, 0); text-align: center;"><span style="color: rgb(51, 51, 51); font-size: 14px; font-weight: 700; text-align: start;">MAX PENDING TICKET PER USER LIMITED TO 3.<br></span>Please ask support to close ticket if issue is fixed.</h2>
                </div>
                @endif
            </div>
            <!--end: Card Body-->
        </div>
    </div>
    <!--end::Container-->
</div>
<style>
    .bold {
        color: #0f66c1;
        font-weight: bold;
    }

    .not-bold {
        color: #0f66c1;
        font-weight: 400;
    }

    .status-message {
        text-transform: capitalize;
    }

    td.status-message {
        text-transform: capitalize;
    }

    .error {
        color: red;
        margin-top: 10px;
    }

    .well1 {
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
    }
</style>
@endsection