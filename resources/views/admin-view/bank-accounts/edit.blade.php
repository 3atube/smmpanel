<form class="form" action="{{route('admin.bank-accounts-edit',[$info->id])}}" method="post" data-xhr="true">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="modal-body">
        <div class="form-group">
            <label class="form-group">Content</label>
            <br>
            <textarea name="bank_content" class="form-control" id="" cols="50" rows="10">{!!$info->bank_content!!}</textarea>
        </div>
        <div class="form-group">
            <label class="form-group">Vị trí</label>
            <input type="number" name="line" class="form-control" value="{!!$info->line!!}">
        </div>
        <!-- <div class="form-group">
            <label class="form-group">The name of the Bank</label>
            <input type="text" name="bank_name" class="form-control" value="{{$info->bank_name}}">
        </div>

        <div class="form-group">
            <label class="form-group">Recipient name</label>
            <input type="text" name="bank_alici" class="form-control" value="{{$info->bank_alici}}">
        </div>

        <div class="form-group">
            <label class="form-group">Branch no</label>
            <input type="text" name="bank_sube" class="form-control" value="{{$info->bank_sube}} ">
        </div>

        <div class="form-group">
            <label class="form-group">Account number</label>
            <input type="text" name="bank_hesap" class="form-control" value="{{$info->bank_hesap}} ">
        </div>

        <div class="form-group">
            <label class="form-group">IBAN</label>
            <input type="text" name="bank_iban" class="form-control" value="{{$info->bank_iban}} ">
        </div> -->


    </div>

    <div class="modal-footer">
        <a id="delete-row" data-url="{{route('admin.bank-accounts-delete',[$info->id])}}" class="btn btn-danger pull-left">remove account</a>
        <button type="submit" class="btn btn-primary">Update bank account</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $("#delete-row").click(function() {
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
                            url: action,
                            type: "DELETE",
                            dataType: "json",
                            cache: false,
                            contentType: false,
                            processData: false
                        })
                        .done(function(result) {
                            if (result.s == "error") {
                                var heading = "Unsuccessful";
                            } else {
                                var heading = "Successful";
                            }
                            $.toast({
                                heading: heading,
                                text: result.m,
                                icon: result.s,
                                loader: true,
                                loaderBg: "#9EC600"
                            });
                            if (result.r != null) {
                                if (result.time == null) {
                                    result.time = 3;
                                }
                                setTimeout(function() {
                                    window.location.href = result.r;
                                }, result.time * 1000);
                            }
                        })
                        .fail(function() {
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