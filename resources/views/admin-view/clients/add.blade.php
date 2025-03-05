<form class="form" action="{{route('admin.clients-new')}}" method="post" data-xhr="true">
    @csrf
    <div class="modal-body">

        <div style="display: none;">
            <div class="form-group">

                <label class="form-group__service-name"> Name</label>

                <input type="text" class="form-control" name="name" value="">

            </div>

            <div class="form-group">

                <label class="form-group__service-name"> Last name</label>

                <input type="text" class="form-control" name="name" value="">

            </div>
        </div>


        <div class="form-group">

            <label> E-mail</label>

            <input type="text" name="email" value="" class="form-control">

        </div>



        <div class="form-group">

            <label>Username</label>

            <input type="text" name="username" class="form-control" value="">

        </div>



        <div class="form-group">

            <label>Password</label>

            <div class="input-group">

                <input type="text" class="form-control" name="password" value="" id="user_password">

                <span class="input-group-btn">

                    <button class="btn btn-default" onclick="UserPassword()" type="button">

                        <span class="fa fa-random" data-toggle="tooltip" data-placement="bottom" title="" aria-hidden="true" data-original-title="Create Password"></span></button>

                </span>

            </div>

        </div>
        <div class="form-group">

            <label>Phone Number</label>

            <input type="text" name="telephone" class="form-control" value="">

        </div>

        <div class="service-mode__block">

            <div class="form-group">

                <label>Debt use</label>

                <select class="form-control" id="debit" name="balance_type">

                    <option value="2">Closed</option>

                    <option value="1">Active</option>

                </select>

            </div>

        </div>



        <div class="form-group" id="debit_limit" style="display: none;">

            <label>Max Debt Amount</label>

            <input type="text" name="debit_limit" class="form-control" value="">

        </div>
    </div>



    <div class="modal-footer">

        <button type="submit" class="btn btn-primary">Approve</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

    </div>

</form>
<script>
    var type = $("#debit").val();

    if (type == 2) {

        $("#debit_limit").hide();

    } else {

        $("#debit_limit").show();

    }

    $("#debit").change(function() {

        var type = $(this).val();

        if (type == 2) {

            $("#debit_limit").hide();

        } else {

            $("#debit_limit").show();

        }

    });

    var type = $("#limit").val();

    if (type == 0) {

        $("#admin_limit").hide();

    } else {

        $("#admin_limit").show();

    }

    $("#limit").change(function() {

        var type = $(this).val();

        if (type == 0) {

            $("#admin_limit").hide();

        } else {

            $("#admin_limit").show();

        }

    });
</script>