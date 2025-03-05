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
                    url: "{{route('account.submit-rating')}}",
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
                url: "{{route('account.submit-load-data')}}",
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
<!--end::Header-->
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="card shadow-sm bg-light mb-5">
            <div class="card-body d-flex align-items-center py-4">
                <div class="d-flex h-50px w-50px h-lg-80px w-lg-80px flex-shrink-0 flex-center position-relative align-self-start align-self-lg-center">
                    <span class="svg-icon svg-icon-primary position-absolute opacity-15">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none" class="h-50px w-50px h-lg-80px w-lg-80px">
                            <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="currentColor"></path>
                        </svg>
                    </span>
                    <span class="svg-icon svg-icon-2x svg-icon-lg-3x svg-icon-primary position-absolute">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                            <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                        </svg>
                    </span>
                </div>
                <div class="ms-6">
                    <p>WELCOME to panel! </p>
                    <p>If you find any service with SAME SPECS (Start time, speed, warranty, drop rate, volumn and support), send us proof, we'll set you lower price!!!</p>
                </div>
            </div>
        </div>
        <div class="card mb-5 mb-xl-10 div-order">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Nav-->
                <ul class="nav nav-pills nav-pills-custom position-relative mx-0 mb-9">
                    <!--begin::Item-->
                    <li class="nav-item mx-0 p-0">
                        <!--begin::Link-->
                        <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#singleorder">
                            <!--begin::Subtitle-->
                            <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Single Order</span>
                            <!--end::Subtitle-->
                            <!--begin::Bullet-->
                            <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                            <!--end::Bullet-->
                        </a>
                        <!--end::Link-->
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                     <li class="nav-item mx-0 px-0">
                        <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#bulkorder">
                            <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Bulk Order</span>
                            <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        </a>
                    </li> 
                </ul>
                <!--end::Nav-->
                <!--begin::Tab Content-->
                <div class="tab-content">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade show active" id="singleorder">
                        <div class="mb-5">
                            <label class="form-label">Category</label>
                            <select class="form-select sl-category" onchange="_order._on.change.category(this.value);">
                            </select>
                        </div>
                        <div class="mb-5">
                            <label class="form-label">Service</label>
                            <select class="form-select sl-service" onchange="_order._on.change.service(this.value);">
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-5">
                                    <label class="required form-label">Link</label>
                                    <input type="text" class="form-control ipt-link">
                                </div>
                                <div class="mb-5">
                                    <label class="required form-label">Quantity</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control ipt-quantity" onkeyup="_order._on.keyup.calculatePrice(0)">
                                        <span class="input-group-text charge">$ 0</span>
                                    </div>
                                </div>
                                <div class="mb-5 service-type custom-comments">
                                    <label class="required form-label">Comments (1 per line)</label>
                                    <textarea class="form-control txa-comment" rows="8" onkeyup="_order._on.keyup.calculatePrice(1)"></textarea>
                                </div>
                                <div class="mb-5 service-type special special-1">
                                    <label class="required form-label service-type special">Suggest
                                        video list/Keyword list</label>
                                    <label class="required form-label service-type special-1">Suggest
                                        video list</label>
                                    <input type="text" class="form-control ipt-suggest">
                                </div>
                                <div class="mb-5 service-type special-1">
                                    <label class="font-weight-bolder">Keyword list<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control ipt-search">
                                </div>
                                <div class="mb-5">
                                    <button type="button" class="btn btn-primary w-100" onclick="_order._on.click.order()">Submit</button>
                                </div>
                                <div class="alert alert-order"></div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-4 mb-5">
                                        <div class="card bg-light card-flush shadow-sm">
                                            <div class="card-header justify-content-end ribbon ribbon-start min-h-60px">
                                                <div class="ribbon-label bg-primary">Price per 1000
                                                </div>
                                            </div>

                                            <div class="card-body text-center fw-bold py-2">
                                                <h5 class="feature-price">-</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5">
                                        <div class="card bg-light card-flush shadow-sm">
                                            <div class="card-header justify-content-end ribbon ribbon-start min-h-60px">
                                                <div class="ribbon-label bg-primary">Min/Max</div>
                                            </div>

                                            <div class="card-body text-center fw-bold py-2">
                                                <h5 class="feature-minmax">-</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5">
                                        <div class="card bg-light card-flush shadow-sm">
                                            <div class="card-header justify-content-end ribbon ribbon-start min-h-60px">
                                                <div class="ribbon-label bg-primary">Speed per day</div>
                                            </div>

                                            <div class="card-body text-center fw-bold py-2">
                                                <h5 class="feature-speed">-</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5">
                                        <div class="card bg-light card-flush shadow-sm">
                                            <div class="card-header justify-content-end ribbon ribbon-start min-h-60px">
                                                <div class="ribbon-label bg-primary">Quality</div>
                                            </div>

                                            <div class="card-body text-center fw-bold py-2">
                                                <h5 class="feature-quality">-</h5>
                                                <a href="javascript:void(0)" data-id="" id="add_review" class="review-quality">Click to review</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5">
                                        <div class="card bg-light card-flush shadow-sm">
                                            <div class="card-header justify-content-end ribbon ribbon-start min-h-60px">
                                                <div class="ribbon-label bg-primary">Start time</div>
                                            </div>

                                            <div class="card-body text-center fw-bold py-2">
                                                <h5 class="feature-start">-</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-5">
                                        <div class="card bg-light card-flush shadow-sm">
                                            <div class="card-header justify-content-end ribbon ribbon-start min-h-60px">
                                                <div class="ribbon-label bg-primary">Guarantee</div>
                                            </div>

                                            <div class="card-body text-center fw-bold py-2">
                                                <h5 class="feature-refill">-</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="div-description"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bulkorder">
                        <div class="mb-5">
                            <label class="required form-label">One order per line in format</label>
                            <textarea class="form-control txa-bulk-order" rows="15" placeholder="service_id | link | quantity
service_id | link | quantity | suggest video list
service_id | link | quantity | keyword search
service_id | link | quantity | suggest video list | keyword search (Mix views)"></textarea>
                        </div>
                        <div class="mb-10">
                            <button type="button" class="btn btn-primary w-100" onclick="_order._on.click.bulkOrder()">Submit</button>
                        </div>
                        <div class="mb-5">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle table-row-gray-300 table-row-bordered fs-7 gy-3 gs-9 table-log-bulk" style="display: none;">
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
<!--begin::Footer-->
<div id="review_modal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="service_id" value="">
            <div class="modal-body">
                <h4 class="text-center mt-2 mb-4">
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                </h4>
                <!-- <div class="form-group">
                    <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                </div> -->
                <div class="form-group text-center mt-4">
                    <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection