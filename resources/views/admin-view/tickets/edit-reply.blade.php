<form class="form" enctype="multipart/form-data" action="{{route('admin.tickets-edit',[$info->id])}}" method="post" data-xhr="true">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="modal-body">
        <div class="form-group">
            <label class="control-label">Message Content</label>
            <textarea class="form-control" rows="5" name="message">{{$info->message}}</textarea>
        </div>
        <div class="form-group">
            <span id="btn-select-img" class="fileUpload a1 btn update-img-profile upl-image-pf">
                <input accept="image/*" type="file" class="upload up" name="file" />
            </span>
            @if($errors->has('file')) <div class="error" style="color: red; margin-bottom: 10px">{{ $errors->first('file') }}</div>
            @endif
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
</form>