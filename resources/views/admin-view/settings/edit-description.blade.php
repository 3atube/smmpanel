<form class="form" action="{{route('edit-description', [$info->id])}}" method="post" data-xhr="true">
    <div class="modal-body"><div class="form-group">
            <label class="form-group__service-name">Explanation   </label>
            <textarea class="form-control" rows="5" name="description"></textarea>
            </div>

    </div>

        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update description</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>