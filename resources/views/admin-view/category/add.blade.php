<form class="form" action="{{route('admin.new-category')}}" method="post" data-xhr="true">
  @csrf
  <div class="modal-body">
    <div class="form-group">
      <label class="form-group__service-name">Category name</label>
      <input type="text" class="form-control" name="name" value="">
    </div>

    <div class="service-mode__block">
      <div class="form-group">
      <label>Personal Category (Only the people you choose can see it.)</label>
        <select class="form-control" name="secret">
              <option value="2">No</option>
              <option value="1">Yes</option>
          </select>
      </div>
    </div>
  </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Create category</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </form>