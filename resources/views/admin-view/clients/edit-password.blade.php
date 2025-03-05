<form class="form" action="{{route('admin.update-user-password', [$info->id])}}" method="post" data-xhr="true">
    @csrf
    <input type="hidden" name="_method" value="PUT">
<div class="modal-body">



  <div class="form-group">

    <label>new password</label>

    <div class="input-group">

      <input type="text" class="form-control" name="password" value="" id="user_password">

      <span class="input-group-btn">

        <button class="btn btn-default" onclick="UserPassword()" type="button">

        <span class="fa fa-random" data-toggle="tooltip" data-placement="bottom" title="" aria-hidden="true" data-original-title="Create Password"></span></button>

      </span>

    </div>

  </div>



</div>



  <div class="modal-footer">

    <button type="submit" class="btn btn-primary">Approve</button>

    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

  </div>

  </form>