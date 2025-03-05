<form class="form" action="{{route('admin.providers.update',[$info->id])}}" method="post" role="form" data-xhr="true">
  @csrf
 <input type="hidden" name="_method" value="PUT">
 <input type="hidden" name="type_api" value="{{$type_api}}">
        <div class="modal-body">

          <div class="form-group">
            <label class="form-group__service-name">Provider Name</label>
            <input type="text" class="form-control" name="api_name" value="{{$info->api_name}}">
          </div>
<hr>

          <div class="form-group">
            <label class="form-group__service-name">API URL</label>
            <input type="text" class="form-control" name="api_url" value="{{$info->api_url}}">
          </div>

          <div class="form-group">
            <label class="form-group__service-name">API Key</label>
            <input type="text" class="form-control" name="api_key" value="{{$info->api_key}}">
          </div>
          <div class="form-group">
            <label class="form-group__service-name">API Key</label>
            <select name="type_api" class="form-control" id="type_api">
              @php $arr = ['urlencoded', 'json'] @endphp
              @foreach($arr as $key => $value)
              <option value="{{$value}}" {{$value == $info->type_api ? 'selected' : ''}}> {{$value}}</option>
              @endforeach
            </select>
          </div>
<hr>
          <div class="form-group">
            <label class="form-group__service-name">Balance Limit <small>(You will receive a notification if your balance drops below this amount)</small></label>
            <input type="text" class="form-control" name="api_limit" value="{{$info->api_limit}}">
          </div>
        </div>
        
          <div class="modal-footer">
         <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <a id="delete-row" data-url="{{route('admin.providers.remove',[$info->id])}}" class="btn btn-link pull-right deactivate-integration-btn">Delete Provider</a>
          </div>
          </form>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <script>
          $("#delete-row").click(function(){
            var action = $(this).attr("data-url");
            swal({
              title: "Are you sure you want to delete?",
              text: "If you confirm, this content will be deleted, it may not be possible to restore it.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              buttons: ["Close", "Yes, I am sure!"],
            })
            .then((willDelete) => {
              if (willDelete) {
                $.ajax({
                  url:  action,
                  type: "DELETE",
                  dataType: "json",
                  cache: false,
                  contentType: false,
                  processData: false
                })
                .done(function(result){
                  if( result.s == "error" ){
                    var heading = "Unsuccessful";
                  }else{
                    var heading = "Successful";
                  }
                    $.toast({
                        heading: heading,
                        text: result.m,
                        icon: result.s,
                        loader: true,
                        loaderBg: "#9EC600"
                    });
                    if (result.r!=null) {
                      if( result.time ==null ){ result.time = 3; }
                      setTimeout(function(){
                        window.location.href  = result.r;
                      },result.time*1000);
                    }
                })
                .fail(function(){
                  $.toast({
                      heading: "Unsuccessful",
                      text: "The request could not be fulfilled",
                      icon: "error",
                      loader: true,
                      loaderBg: "#9EC600"
                  });
                });
                /* Content deletion confirmed */
              } else {
                $.toast({
                    heading: "Unsuccessful",
                    text: "Deletion request denied",
                    icon: "error",
                    loader: true,
                    loaderBg: "#9EC600"
                });
              }
            });
          });
          </script>