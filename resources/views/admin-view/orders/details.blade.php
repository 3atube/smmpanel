<div class="modal-body">
    <div class="form-group">
        <textarea class="form-control" rows="5" name="description[en]">{!!$info->details!!}</textarea>
        @if($response)
        <b>Current Response</b>
        <textarea class="form-control" rows="5" name="description[en]">{!!$response!!}</textarea>
        @endif
    </div>
</div>
