<form class="form" action="{{ route('admin.update-admin', [$info->id]) }}" method="post" data-xhr="true">

    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="modal-body">





        <div class="form-group">

            <label> E-mail</label>

            <input type="text" name="email" value="{{ $info->email }}" class="form-control">

        </div>



        <div class="form-group">

            <label>Username</label>

            <input type="text" name="name" class="form-control" value="{{ $info->name }}">

        </div>

        <div class="form-group">

            <label>Send Mail</label>
            <select class="form-control" name="send_email" id="send_email">
                @for ($i = 0; $i <= 1; $i++)
                    <option value={{ $i }} {{ $i == $info->send_email ? 'selected' : '' }}>
                        {{ $i == 1 ? 'Bật' : 'Tắt' }}</option>
                @endfor
            </select>

        </div>


        <div class="modal-footer">

            <button type="submit" class="btn btn-primary">Update</button>

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        </div>

</form>
