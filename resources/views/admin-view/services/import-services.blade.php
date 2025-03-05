<form class="form" action="{{route('admin.get-services-add')}}" method="post" data-xhr="true">
  @csrf
  <div class="modal-body">

    <div id="firstStep">
      <div class="service-mode__block">
        <div class="form-group">
          <label>Service Provider</label>
          <select class="form-control" name="provider" id="provider">
            <option value="">Select service provider...</option>
            @if(!empty($providers))
            @foreach($providers as $item)
            <option value="{{$item->id}}">{{$item->api_name}}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="service-mode__block">
        <div class="form-group">
          <label>Select the Category to Add the Services</label>
          <select class="form-control" name="selector" id="selector">
            <option value="">Choose category...</option>
            @if(!empty($categories))
            @foreach($categories as $item)
            <option value="{{$item->id}}">{{$item->category_name}}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>
    </div>


    <div id="secondStep">
    </div>

    <div id="thirdStep">
    </div>


  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" id="nextStep" data-step="first">Next step</button>
    <button type="submit" class="btn btn-primary" id="submitStep" style="display: none;">Add services</button>
  </div>

</form>
<script>
  $("#submitStep").hide();
  $("#nextStep").click(function() {
    var now_step = $(this).attr("data-step");
    var provider = $("#provider").val();
    var category = $("#selector").val();
    $("#secondStep").hide();
    if (now_step == "first") {

      if (provider == 0 || category == 0) {
        $.toast({
          heading: "Unsuccessful",
          text: "Lütfen boş alan bırakmayınız",
          icon: "error",
          loader: true,
          loaderBg: "#9EC600"
        });
      } else {
        $("#firstStep").hide();
        $("#secondStep").show();
        $.post("admin/ajax_data", {
          provider: provider,
          category: category,
          action: "import_services_list"
        }, function(data) {
          $("#secondStep").html(data);
        });
        $("#nextStep").attr("data-step", "second");
      }
    } else if (now_step == "second") {
      var array = [];
      $('[class^="selectServices-"]').each(function() {
        var id = $(this).val();
        var check = $(this).prop("checked");
        var provider = $(this).attr("data-provider");
        if (check == true) {
          var params = {};
          params["id"] = id;
          params["category"] = $(this).attr("data-category");
          array.push(params);
        }
      });
      var count = array.length;
      if (count) {
        $.post("admin/ajax_data", {
          provider: provider,
          action: "import_services_last",
          services: array
        }, function(data) {
          $("#thirdStep").html(data);
        });
        $("#nextStep").hide();
        $("#submitStep").show();
      } else {
        $("#nextStep").attr("data-step", "second");
        $("#firstStep").hide();
        $("#secondStep").show();
        $("#nextStep").show();
        $("#submitStep").hide();
        $.toast({
          heading: "Unsuccessful",
          text: "Lütfen eklemek istediğiniz en az 1 servisi seçin",
          icon: "error",
          loader: true,
          loaderBg: "#9EC600"
        });
      }

    }
  });
</script>