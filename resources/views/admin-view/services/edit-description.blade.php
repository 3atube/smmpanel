<form class="form" action="{{route('admin.edit-description', [$info->id])}}" method="post" data-xhr="true">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="modal-body">
                <div class="form-group">
                        <label class="form-group__service-name">Speed per day </label>
                        <input type="text" class="form-control" name="speed_per_day" value="{!!$info->speed_per_day!!}">
                </div>

        </div>
        <div class="modal-body">
                <div class="form-group">
                        <label class="form-group__service-name">Start time </label>
                        <input type="text" class="form-control" name="start_time" value="{!!$info->start_time!!}">
                </div>

        </div>
        <div class="modal-body">
                <div class="form-group">
                        <label class="form-group__service-name">Guarantee </label>
                        <input type="text" class="form-control" name="guarantee" value="{!!$info->guarantee!!}">
                </div>

        </div>
        <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update description</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
</form>
