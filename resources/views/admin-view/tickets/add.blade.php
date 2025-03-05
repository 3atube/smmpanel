<form class="form" action="{{route('admin.tickets-new')}}" method="post" data-xhr="true">
    @csrf
        <div class="modal-body">

          <div class="form-group">
            <label class="form-group__service-name">Username</label>
            <input type="text" class="form-control" name="username" value="">
          </div>

          <div class="form-group">
            <label class="form-group__service-name">Subject</label>
            <input type="text" class="form-control" name="subject" value="">
          </div>

          <div class="form-group">
            <label class="form-group__service-name">Your message</label>
            <textarea class="form-control" name="message" rows="4"></textarea>
          </div>


        </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Create new request</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          </form>