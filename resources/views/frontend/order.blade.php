@extends('frontend.layouts.app')
@section('scriptFooter')
    <script>
        typeof _order !== 'undefined' && _order.init();
    </script>
    <style>
        .progress-label-left {
            float: left;
            margin-right: 0.5em;
            line-height: 1em;
        }

        .progress-label-right {
            float: right;
            margin-left: 0.3em;
            line-height: 1em;
        }

        .star-light {
            color: #e9ecef;
        }
    </style>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#review_modal button.close', function() {
                var service_id = $('#service_id').val();
                if (service_id > 0) {
                    load_rating_data(service_id)
                }
                $('#review_modal').modal('hide');
                $('#user_review').val('');
            })
            var rating_data = 0;

            $('#add_review').click(function() {
                $('#review_modal').modal('show');
                $('#service_id').val($(this).attr('data-id'))

            });

            $(document).on('mouseenter', '.submit_star', function() {

                var rating = $(this).data('rating');

                reset_background();

                for (var count = 1; count <= rating; count++) {

                    $('#submit_star_' + count).addClass('text-warning');

                }

            });

            function reset_background() {
                for (var count = 1; count <= 5; count++) {

                    $('#submit_star_' + count).addClass('star-light');

                    $('#submit_star_' + count).removeClass('text-warning');

                }
            }

            $(document).on('mouseleave', '.submit_star', function() {

                reset_background();

                for (var count = 1; count <= rating_data; count++) {

                    $('#submit_star_' + count).removeClass('star-light');

                    $('#submit_star_' + count).addClass('text-warning');
                }

            });

            $(document).on('click', '.submit_star', function() {

                rating_data = $(this).data('rating');

            });

            function Validate(evt) {
                var isValid = false;
                var regex = /^([\s\.]?[a-zA-Z0-9]+)+$/;
                isValid = regex.test(evt);
                return isValid;
            }

            $('#save_review').click(function() {


                var user_review = $('#user_review').val();
                var service_id = $('#service_id').val();
                if (user_review == '') {
                    alert("Please Fill Both Field");
                    return false;
                } else {
                    $.ajax({
                        url: "{{ route('account.submit-rating') }}",
                        method: "POST",
                        data: {
                            service_id: service_id,
                            rating_data: rating_data,
                            user_review: user_review
                        },
                        success: function(data) {
                            if (data.error) {
                                alert(data.message);
                            }
                            if (data.success) {
                                $('#review_modal').modal('hide');
                                alert(data.message);
                                $('#add_review').hide()
                                load_rating_data(service_id);
                            }

                        }
                    })
                }
            });

            function load_rating_data(service_id) {
                $.ajax({
                    url: "{{ route('account.submit-load-data') }}",
                    method: "POST",
                    data: {
                        service_id: service_id,
                        action: 'load_data'
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success) {
                            $('.feature-quality').html(data.message);
                        }
                    }
                })
            }
        });
    </script>
@endsection
@section('content')
    <div id="block_6">
        <div class="new_order-block">
            <div class="bg"></div>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
            <div class="container-fluid div-order">
                <div class="row new-order-form ">
                    <div class="col-lg-8">
                        <div class="component_form_group component_card component_radio_button">
                            @php $setting = \App\Libraries\Helpers::infoSetting()@endphp
                            @if($setting && $setting->custom_banner)
                            <div class="alert text-danger alert-light d-flex align-items-center p-3 mb-3 mt-3">
                                <div class="d-flex flex-column">{!!$setting->custom_banner!!}</div>
                            </div>
                            @endif
                            <div class="card">
                                <div class="component_button_forms">
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select class="form-select form-control sl-category"
                                            onchange="_order._on.change.category(this.value);">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Service</label>
                                        <select class="form-select form-control sl-service"
                                            onchange="_order._on.change.service(this.value);">
                                        </select>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="required form-label">Link</label>
                                                <input type="text" class="form-control ipt-link">
                                            </div>
                                            <div class="form-group">
                                                <label class="required form-label">Quantity</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control ipt-quantity"
                                                        onkeyup="_order._on.keyup.calculatePrice(0)">
                                                    <span class="input-group-text charge">$ 0</span>
                                                </div>
                                            </div>
                                            <div class="mb-5 service-type custom-comments form-group">
                                                <label class="required form-label">Comments (1 per line)</label>
                                                <textarea class="form-control txa-comment" rows="8" onkeyup="_order._on.keyup.calculatePrice(1)"></textarea>
                                            </div>
                                            <div class="mb-5 service-type special special-1 form-group">
                                                <label class="required form-label service-type special">Suggest
                                                    video list/Keyword list</label>
                                                <label class="required form-label service-type special-1">Suggest
                                                    video list</label>
                                                <input type="text" class="form-control ipt-suggest">
                                            </div>
                                            <div class="mb-5 service-type special-1 form-group">
                                                <label class="font-weight-bolder">Keyword list<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control ipt-search">
                                            </div>
                                            <div class="form-group">
                                                <label for="charge" class="control-label">Charge</label>
                                                <input type="text" class="form-control" id="charge" value=""
                                                    readonly="">
                                            </div>
                                            <div class="mb-5 schedule" >
                                                <div class="form-check form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input cb-schedule" type="checkbox" onclick="_order._on.change.schedule(this.checked)" />
                                                    <label class="form-check-label"><span data-lang="Schedule" class="fw-bold">Đặt lịch chạy</span>. <span data-lang="Your timezone">Múi giờ</span>: <span class="fw-bolder">{!!Helpers::convertTimezoneToString(Auth::user()->time_zone)!!}</span></label>
                                                </div>
                                            </div>
                                            <div class="mb-5 schedule-time" style="display: none;">
                                                <div class="form-group">
                                                    <input type="text" class="form-control ipt-schedule-time" readonly="true">
                                                    <label data-lang="Choose time">Choose time</label>
                                                </div>
                                            </div>
                                            <div class="mb-5 loop" >
                                                <div class="form-check form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input cb-loop" type="checkbox" onclick="_order._on.change.loop(this.checked)" />
                                                    <label class="form-check-label"><span data-lang="Loop" class="fw-bold">Đặt hàng lặp lại</span>. <span data-lang="Loop desciption">Tự động đặt lại đơn hàng sau khi đơn hàng này <span class="fw-bolder">HOÀN THÀNH</span>. Đảm bảo số dư của bạn đủ cho các đơn hàng sau.</span></label>
                                                </div>
                                            </div>
                                            <div class="mb-5 loop-quantity" style="display: none;">
                                                <div class="form-group">
                                                    <select class="form-control sl-loop-quantity" data-kt-select2="true" data-hide-search="true">
                                                    <option value=1>1</option><option value=2>2</option><option value=3>3</option><option value=4>4</option><option value=5>5</option><option value=6>6</option><option value=7>7</option><option value=8>8</option><option value=9>9</option><option value=10>10</option><option value=15>15</option><option value=20>20</option><option value=25>25</option><option value=30>30</option><option value=35>35</option><option value=40>40</option><option value=45>45</option><option value=50>50</option>                        </select>
                                                    <label data-lang="Loop quantity">Loop quantity</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="new-order-button-submit component_button_submit">
                                    <button type="button" class="btn btn-primary"
                                    onclick="_order._on.click.order()">Submit</button>
                                </div>

                                <div class="alert alert-order" style="margin: 10px 0"></div>
                                <div class="form-group fields component_service_description" id="service_description">
                                    <label for="service_description" class="control-label">Description</label>
                                    <div class="div-description"></div>
                                </div>
                                <div class="tab-pane fade" id="bulkorder">
                                    <div class="mb-5">
                                        <label class="required form-label">One order per line in format</label>
                                        <textarea class="form-control txa-bulk-order" rows="15"
                                            placeholder="service_id | link | quantity
                                                service_id | link | quantity | suggest video list
                                                service_id | link | quantity | keyword search
                                                service_id | link | quantity | suggest video list | keyword search (Mix views)"></textarea>
                                    </div>
                                    <div class="mb-10">
                                        <button type="submit" class="btn btn-big-primary"
                                            onclick="_order._on.click.bulkOrder()">Submit</button>
                                    </div>
                                    <div class="mb-5">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-hover align-middle table-row-gray-300 table-row-bordered fs-7 gy-3 gs-9 table-log-bulk"
                                                style="display: none;">
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    
                </div>
                <!--end::Container-->
            </div>
            <!--end::Content-->
        @endsection
