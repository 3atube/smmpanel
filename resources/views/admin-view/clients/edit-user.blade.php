<form class="form" action="{{route('admin.update-user', [$info->id])}}" method="post" data-xhr="true">

    @csrf
    <input type="hidden" name="_method" value="PUT">
<div class="modal-body">





  <div class="form-group">

    <label> E-mail</label>

    <input type="text" name="email" value="{{$info->email}}" class="form-control">

  </div>



  <div class="form-group">

    <label>Username</label>

    <input type="text" name="name" class="form-control" value="{{$info->name}}">

  </div>



  <div class="form-group">

    <label>Phone Number</label>

    <input type="text" name="phone" class="form-control" value="{{$info->phone}}">

  </div> 

<div class="form-group">

    <label>API Key</label>

    <div class="input-group">

      <input type="text" class="form-control" value="{{$info->key_api}}" id="key_api" disabled="">

      <span class="input-group-btn">

       <a href="{{route('admin.client-change-api', [$info->id])}}" class="btn btn-default">

        <span class="fa fa-random" data-toggle="tooltip" data-placement="bottom" title="" aria-hidden="true" data-original-title="Generate API Key"></span></a>

      </span>

    </div>

  </div>


  <div class="service-mode__block">

    <div class="form-group">

    <label>Debt use</label>

      <select class="form-control" id="debit" name="balance_type">
            @php $balance_type = [2=>'Closed' , 1=>'Open'] @endphp
            @foreach($balance_type as $key => $value)
            <option value="{{$key}}" {{$info->balance_type==$key}} selected="">{{$value}}</option>
            @endforeach
        </select>

    </div>

  </div>

</div>



  <div class="modal-footer">

    <button type="submit" class="btn btn-primary">Update</button>

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

  </div>

  </form>