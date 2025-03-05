<form class="form" action="{{route('admin.languages.add')}}" method="post" data-xhr="true">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label class="form-group__service-name">Key</label>
            <input type="text" class="form-control" name="language_key" value="">
        </div>

        <div class="form-group">
            <label class="form-group__service-name">Value</label>
            <input type="text" class="form-control" name="language_value" value="">
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Create new</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>