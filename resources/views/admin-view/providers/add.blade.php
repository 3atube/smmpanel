<form class="form" action="{{route('admin.providers.add')}}" method="post" data-xhr="true">
  @csrf
  <div class="modal-body">

    <div class="form-group">
      <label class="form-group__service-name">API URL</label>
      <input type="text" class="form-control" name="url" value="{{old('url')}}">
    </div>
    
              <div class="form-group">
      <label class="form-group__service-name">API Key</label>
      <input type="text" class="form-control" name="key" value="{{old('key')}}">
    </div>

  </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Add provider</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </form>