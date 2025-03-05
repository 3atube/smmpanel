<form class="form" action="{{route('admin.languages.edit', $info->id)}}" method="post" data-xhr="true">
    <input type="hidden" value="PUT" name="_method">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label class="form-group__service-name">Key</label>
            <input type="text" class="form-control" name="language_key" value="{{$info->language_key}}">
        </div>

        <div class="form-group">
            <label class="form-group__service-name">Value</label>
            <input type="text" class="form-control" name="language_value" value="{{$info->language_value}}">
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>