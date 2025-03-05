<form class="form" action="{{route('admin.payments.update-online',$info->id)}}" method="post" data-xhr="true">
    @csrf
    <input type="hidden" value="PUT" name="_method">
    <input type="hidden" name="type" value="{{$type}}">
    <div class="modal-body">
        @if($type=='method')
        <div class="service-mode__block">
            <div class="form-group">
                <label>Payment method</label>
                <select class="form-control" name="payment_method">
                    @if(count($items)>0)
                    @foreach($items as $item)
                    <option value="{{$item->id}}" {{$info->payment_method==$item->id ? 'selected=""' : ''}} >{{$item->method_name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        @endif
        @if($type=='bank')
        <div class="service-mode__block">
            <div class="form-group">
                <label>Bank</label>
                <select class="form-control" name="payment_bank">
                    @if(count($itemsBank)>0)
                    @foreach($itemsBank as $item)
                    <option value="{{$item->id}}" {{$info->payment_bank==$item->id ? 'selected=""' : ''}} >{{$item->bank_name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label class="form-group__service-name">NOTE</label>
            <input type="text" class="form-control" name="payment_note" value="{{$info->payment_note}}">
        </div>


    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Settings</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>