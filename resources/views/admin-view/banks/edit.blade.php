<form class="form" action="https://smm.magicpi.top/admin/payments/edit-bank/34" method="post" data-xhr="true">

    <div class="modal-body">

        <div class="service-mode__block">
            <div class="form-group">
                <label>Payment bank</label>
                <select class="form-control" name="bank">
                    <option value="1" selected="">Vietcombank</option>
                </select>
            </div>
        </div>

        <div class="service-mode__block">
            <div class="form-group">
                <label>Payment status</label>
                <select class="form-control" disabled="" name="status">
                    <option value="1">pending</option>
                    <option value="2">Cancel</option>
                    <option value="3" selected="">Approved</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group__service-name">NOTE</label>
            <input type="text" class="form-control" name="note" value="10">
        </div>


    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Settings</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>