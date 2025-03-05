<form class="form" action="{{$type=='remains' ? route('admin.orders.update-partial', $info->id) : route('admin.orders.update', $info->id)}}" method="post" {{$type=='remains' ? 'data-xhr="true"' : ''}}>
  @csrf
  <input type="hidden" value="PUT" name="_method">
  <div class="modal-body">
    <input type="hidden" name="type" value="{{$type}}">
    @if($type=='url')
    <div class="service-mode__block">
      <div class="form-group">
        <label>Order Link</label>
        <input class="form-control" value="{{$info->order_url}}" name="order_url">
      </div>
    </div>
    <div class="service-mode__block">
      <div class="form-group">
        <label>Active Provider</label>
        <select name="is_active_provider" class="form-control" id="is_active_provider">
          <option value="1" {{$info->is_active_provider == 1 ? 'selected' : ''}}>Chọn provider mới nhất | hiện tại</option>
          <option value="0" {{$info->is_active_provider == 0 ? 'selected' : ''}}>Chọn provider cũ</option>
        </select>
      </div>
    </div>
    @endif
    @if($type=='start')
    <div class="service-mode__block">
      <div class="form-group">
        <label>Number of starts</label>
        <input class="form-control" value="{{$info->order_start}}" name="order_start">
      </div>
    </div>
    @endif
    @if($type=='remains')
    <div class="service-mode__block">
      <div class="form-group">
        <label>Remains</label>
        <input class="form-control" type="number" value="" placeholder="Remains" name="order_remains">
      </div>
    </div>
    @endif
    @if($type=='comments')
    <div class="service-mode__block">
      <div class="form-group">
        <label>Comments</label>
        <textarea class="form-control" name="order_extras" rows="8">{!!$info->order_extras!!}</textarea>
      </div>
    </div>
    @endif
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">{{$title ? $title : 'Update'}}</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>