@extends('frontend.layouts.app')
@section('scriptFooter')
<script>
    typeof _order !== 'undefined' && _order.init();
</script>
@endsection
@section('content')
    <div id="block_27">
        <div class="new_order-block">
            <div class="bg"></div>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
            <div class="container-fluid">
                <div class="row mass-order__alignment div-order">
                    <div class="col-lg-5">
                        <div class="component_card">
                            <div class="card">
                                <div class="component_form_group">
                                    <div class="">
                                        <div class="form-group">
                                            <label for="links" class="control-label">One order per line in
                                                format</label>
                                            <textarea class="form-control txa-bulk-order" rows="15" id="links" placeholder="service_id | link | quantity"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="component_button_submit">
                                    <div class="">
                                        <button type="submit" class="btn btn-block btn-big-primary"
                                            onclick="_order._on.click.bulkOrder()">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
