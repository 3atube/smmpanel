@extends('frontend.layouts.app')
@section('scriptFooter')
    <script>
        typeof _history !== 'undefined' && _history.init();
        $(document).on('click', '.add-task', function() {
            var order_id = $(this).attr('data-id');
            var type = $(this).attr('data-type');
            $.ajax({
                url: "{{ route('account.add-task') }}",
                method: "POST",
                data: {
                    type: type,
                    order_id: order_id
                },
                success: function(data) {
                    if (data.error) {
                        alert(data.message);
                    }
                    if (data.success) {
                        alert(data.message);
                        if (type == 'refill') {
                            $('.refill-' + order_id).removeClass('add-task')
                            $('.refill-' + order_id).removeClass('cursor')
                            $('.refill-' + order_id).html('Refilled')
                        } else if (type == 'partial') {
                            $('.partial-' + order_id).html('Partialed')
                            $('.partial-' + order_id).removeClass('add-task')
                            $('.partial-' + order_id).removeClass('cursor')
                        }
                    }

                }
            })
        })
    </script>
    <style>
        .cursor {
            cursor: pointer;
        }

        .refilled {
            background: #3699ff;
            margin-left: 10px !important;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <!--end::Header-->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid">
       
        <!--begin::Container-->
        <div class="container-fluid">
            @php $setting = \App\Libraries\Helpers::infoSetting()@endphp
            @if($setting && $setting->custom_banner)
            <div class="alert text-danger alert-light d-flex align-items-center p-3 mb-3 mt-3">
                <div class="d-flex flex-column">{!!$setting->custom_banner!!}</div>
            </div>
            @endif
            <!--begin::Card-->
            <div class="card div-history">
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <div class="row pt-9 px-9">
                        <div class="col-lg mb-5 form-group">
                            <label class="form-label">Status</label>
                            <select class="form-select form-control form-select-sm datatable-input" data-kt-select2="true"
                                data-hide-search="true" data-col-index="8">
                                <option value="">All</option>
                                <option value="Pending">Pending</option>
                                <option value="Processing">Processing</option>
                                <option value="In progress">In progress</option>
                                <option value="Completed">Completed</option>
                                <option value="Partial">Partial</option>
                                <option value="Canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="col-lg mb-5 form-group">
                            <div class="mb-5">
                                <label class="form-label fs-6">Order ID</label>
                                <input type="number" class="form-control form-control-sm datatable-input"
                                    data-col-index="0" />
                            </div>
                        </div>
                        <div class="col-lg mb-5 form-group">
                            <div class="mb-5">
                                <label class="form-label fs-6">Link</label>
                                <input type="text" class="form-control form-control-sm datatable-input"
                                    data-col-index="3" />
                            </div>
                        </div>
                        <div class="col-lg mb-5 form-group">
                            <div class="mb-5">
                                <label class="form-label fs-6">Service ID</label>
                                <input type="number" class="form-control form-control-sm datatable-input"
                                    data-col-index="9" />
                            </div>
                        </div>
                        <div class="col-lg mb-5 form-group">
                            <label class="form-label">Filter</label>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm me-2"
                                    onclick="_history._on.click.filter()">Apply</button>
                                <button type="button" class="btn btn-light btn-sm"
                                    onclick="_history._on.click.resetFilter()">Reset</button>
                            </div>
                        </div>
                    </div>
                    <!--begin::Table-->
                    <div class="table-responsive history-list">
                        <table class="table align-middle table-row-bordered fs-7 gy-2 gs-9">
                            <thead class="fs-6 fw-bold bg-lighten">
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Created/Updated</th>
                                    <th>Link</th>
                                    <th>Charge</th>
                                    <th>Quantity</th>
                                    <th>Start</th>
                                    <th>Remains</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
    <div class="modal fade" tabindex="-1" id="modal-quantity-more-order">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title">
                        More Order
                    </h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="required form-label">Order ID</label>
                        <input type="text" disabled class="form-control ipt-order-id order-id" />
                    </div>
                    <div class="mb-5">
                        <label class="required form-label">Quantity</label>
                        <input type="number" class="form-control quantity-order-id" />
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary btn-icon w-100"
                            onclick="_tickets._on.click.more_quantity(document.querySelector('.order-id').value, document.querySelector('.quantity-order-id').value, true);"><i
                                class="las la-paper-plane me-1 fs-2"></i>Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--begin::Modal report order-->
    <div class="modal fade" tabindex="-1" id="modal-ticket-order">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title">
                        Report Order
                    </h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="required form-label">Order ID</label>
                        <input type="text" disabled class="form-control ipt-order-id order-id1" />
                    </div>
                    <div class="mb-5 form-group">
                        <label class="required form-label">Request</label>
                        <select class="form-select form-control sl-request" data-kt-select2="true" data-hide-search="true">
                            <option value="2" data-lang="Refill">Refill</option>
                            <option value="4">Other</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label">Request</label>
                        <textarea rows="5" class="form-control txa-message" placeholder="Your message"></textarea>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary btn-icon w-100"
                            onclick="_tickets._on.click.add('Order', document.querySelector('.order-id1').value, document.querySelector('.sl-request').value, document.querySelector('.txa-message').value, true);"><i
                                class="las la-paper-plane me-1 fs-2"></i>Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modal-ticket-order-completed">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header py-3">
                    <h5 class="modal-title">
                        Report Order
                    </h5>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span class="svg-icon svg-icon-2x">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="mb-5">
                        <label class="required form-label">Order ID</label>
                        <input type="text" disabled class="form-control ipt-order-id order-id2" />
                    </div>
                    <div class="mb-5 form-group">
                        <label class="required form-label">Request</label>
                        <select class="form-select form-control sl-request sl-request2" data-kt-select2="true" data-hide-search="true">
                            <option value="1" data-lang="Cancel & Partial">Cancel & Partial</option>
                            <option value="3" data-lang="Speed up">Speed up</option>
                            <option value="4">Other</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label class="required form-label">Request</label>
                        <textarea rows="5" class="form-control txa-message2" placeholder="Your message"></textarea>
                    </div>
                    <div>
                        <button type="button" class="btn btn-primary btn-icon w-100"
                            onclick="_tickets._on.click.add('Order', document.querySelector('.order-id2').value, document.querySelector('.sl-request2').value, document.querySelector('.txa-message').value, true);"><i
                                class="las la-paper-plane me-1 fs-2"></i>Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal report order-->
    <!--begin::Footer-->
@endsection
