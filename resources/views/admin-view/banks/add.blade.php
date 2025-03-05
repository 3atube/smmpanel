<form class="form" action="{{route('admin.payments.new-bank')}}" method="post" data-xhr="true">
@csrf
<div class="modal-body">


  <div class="form-group">
    <label class="form-group__service-name">Username</label>
    <input type="text" class="form-control" name="username" value="">
  </div>

  <div class="form-group">
    <label class="form-group__service-name">Tutar</label>
    <input type="text" class="form-control" name="amount" value="">
  </div>

  <div class="service-mode__block">
    <div class="form-group">
    <label>Payment bank</label>
      <select class="form-control" name="bank">
        @if(!empty($items))
        @foreach($items as $item)
        <option value="{{$item->id}}">{{$item->bank_content}}</option>
        @endforeach
        @endif
      </select>
    </div>
  </div>


  <div class="form-group">
    <label class="form-group__service-name">NOTE</label>
    <input type="text" class="form-control" name="note" value="">
  </div>


</div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Add payment</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
  </form>