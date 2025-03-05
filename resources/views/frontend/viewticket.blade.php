@extends('frontend.layouts.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-12 mb-xl-10 div-order">
              <div class="card-body">
                <div class="well  ">
                    <div class="titcket-title">{{ $info->subject }}</div>
                    @if (count($items))
                        @foreach ($items as $item)
                            @if ($item->support == 1)
                                <div class="row ticket-message-block ticket-message-right">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-11">
                                        <div class="ticket-message">
                                            <div class="message">{{ $item->message }}</div>
                                        </div>
                                        <div class="info text-right">
                                            <strong>{{ $item->user ? $item->user->name : '' }}</strong>
                                            <small class="text-muted">{{ $item->created_at }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            @endif
                            @if ($item->support == 2)
                                <div class="row ticket-message-block ticket-message-left">
                                    <div class="col-md-11">
                                        <div class="ticket-message">
                                            <div class="message">{{ $item->message }}</div>
                                        </div>
                                        <div class="info">
                                            <strong>support</strong>
                                            <small class="text-muted">{{ $item->created_at }}</small>
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <br>
                    @if ($info->status != 'closed' && $info->canmessage == 2)
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('account.reply-ticket', [$info->id]) }}">
                                    @csrf
                                    <div class="form-group panel-border-top">
                                        <label for="message" class="control-label">Message</label>
                                        <br>
                                        <textarea id="message" rows="5" class="form-control" name="message"></textarea>
                                    </div>
                                    @if ($errors->has('message'))
                                        <div class="error">{{ $errors->first('message') }}</div>
                                    @endif
                                    <br>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            
            </div>
            
            </div>
        </div>
        <!--end::Post-->
    </div>
    <style>
      .error {
          color: red;
          margin-top: 10px;
      }
  
      .titcket-title {
          font-size: 18px;
          padding-bottom: 10px;
          border-bottom: 1px solid #ddd;
          margin-bottom: 10px;
      }
  
      .ticket-message-right {}
  
      .ticket-message .message {
          color: #000
      }
  
      .ticket-message-right .ticket-message {
          background: #ddd;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
          padding: 15px;
      }
  
      .ticket-message-left {}
  
      .ticket-message-left .ticket-message {
          background: #ccc;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
          padding: 15px;
      }
  
      .ticket-message-block {
          margin-bottom: 15px;
      }
  
      .ticket-message {
          word-break: break-word;
      }
  </style>
@endsection
