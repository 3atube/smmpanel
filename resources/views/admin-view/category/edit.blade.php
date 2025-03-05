<form class="form" action="{{route('admin.update-category',[$info->id])}}" method="post" data-xhr="true">
@csrf
 <input type="hidden" name="_method" value="PUT">
  <div class="modal-body">
    <div class="form-group">
      <label class="form-group__service-name">Category name</label>
      <input type="text" class="form-control" name="category_name" value="{{$info->category_name}}">
    </div>

    <div class="service-mode__block">
      <div class="form-group">
      <label>Personal Category (Only the people you choose can see it.)</label>
        <select class="form-control" name="category_secret">
              <option value="2" {{$info->category_secret=='2' ? 'selected=""' : ''}} >No</option>
              <option value="1" {{$info->category_secret=='1' ? 'selected=""' : ''}}>Yes</option>
          </select>
      </div>
    </div>
  </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Update category</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </form>