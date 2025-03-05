<form class="form" action="{{route('admin.bank-accounts-new')}}" method="post" data-xhr="true">
    @csrf
    <div class="modal-body">

        <div class="form-group">
            <label class="form-group">Content</label>
            <br>
            <textarea name="bank_content" class="form-control" id="" cols="50" rows="10"></textarea>
        </div>
         <div class="form-group">
            <label class="form-group">Vị trí</label>
            <input type="number" name="line" class="form-control" value="1">
        </div>
        <!--
        <div class="form-group">
            <label class="form-group">Recipient name</label>
            <input type="text" name="bank_alici" class="form-control" value="">
        </div>

        <div class="form-group">
            <label class="form-group">Branch no</label>
            <input type="text" name="bank_sube" class="form-control" value="">
        </div>

        <div class="form-group">
            <label class="form-group">Account number</label>
            <input type="text" name="bank_hesap" class="form-control" value="">
        </div>

        <div class="form-group">
            <label class="form-group">IBAN</label>
            <input type="text" name="bank_iban" class="form-control" value="">
        </div> -->


    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add new bank account</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>