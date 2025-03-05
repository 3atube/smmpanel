@extends('frontend.pages.app')
@section('scriptFooter')
<script>
    typeof _api !== 'undefined' && _api.init();
    var _api = {
        init() {

        },

        _on: {
            change: {
                addType(option) {
                    $('.options').hide();
                    $(`.${option}`).show()
                }
            }
        }
    }
</script>
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <div class="card mb-5 mb-xl-10">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="table-responsive mb-10">
                        <table class="table table-row-bordered table-row-gray-300 align-middle gy-3">
                            <tbody>
                                <tr>
                                    <td>API Url</td>
                                    <td class="fw-bolder">{{route('api.v2')}}</td>
                                </tr>
                                <tr>
                                    <td>API Key</td>
                                    <td class="fw-bolder">Get <a href="/account">here</a></td>
                                </tr>
                                <tr>
                                    <td>HTTP Method</td>
                                    <td class="fw-bolder">POST</td>
                                </tr>
                                <tr>
                                    <td>Content-Type</td>
                                    <td class="fw-bolder">application/x-www-form-urlencoded</td>
                                </tr>
                                <tr>
                                    <td>Response format </td>
                                    <td class="fw-bolder">JSON</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--begin::Nav-->
                    <ul class="nav nav-pills nav-pills-custom position-relative mx-0 mb-9">
                        <!--begin::Item-->
                        <li class="nav-item mx-0 p-0">
                            <!--begin::Link-->
                            <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#services">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Services</span>
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
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#add">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Add</span>
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
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#status">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Status</span>
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
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#multistatus">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Multi status</span>
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
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#balance">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">Balance</span>
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
                            <!--begin::Link-->
                            <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#phpcode">
                                <!--begin::Subtitle-->
                                <span class="nav-text text-gray-800 fw-bolder fs-6 mb-3">PHP Code</span>
                                <!--end::Subtitle-->
                                <!--begin::Bullet-->
                                <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                <!--end::Bullet-->
                            </a>
                            <!--end::Link-->
                        </li>
                        <!--end::Item-->
                        <!--begin::Bullet-->
                        <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
                        <!--end::Bullet-->
                    </ul>
                    <!--end::Nav-->
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Tap pane-->
                        <div class="tab-pane fade show active" id="services">
                            <table class="table table-row-bordered table-row-gray-300 align-middle gy-2">
                                <tbody>
                                    <tr>
                                        <td class="fw-bolder">Parameters</td>
                                        <td class="fw-bolder">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>services</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6>Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html">[
    {
        "service": 1,
        "name": "Youtube views",
        "type": "Default",
        "category": "Youtube",
        "rate": "2.5",
        "min": "200",
        "max": "10000"
    },
    {
        "service": 2,
        "name": "Facebook comments",
        "type": "Custom Comments",
        "category": "Facebook",
        "rate": "4",
        "min": "10",
        "max": "1500"
    }
]
</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="add">
                            <div class="mb-5">
                                <label class="form-label">Type</label>
                                <select class="form-select form-select-solid form-select-sm sl-type-add" onchange="_api._on.change.addType(this.value)">
                                    <option value="default">Default</option>
                                    <option value="custom-comments">Custom Comments</option>
                                    <option value="special">Special</option>
                                    <option value="special1">Special 1</option>
                                </select>
                            </div>
                            <table class="table table-row-bordered table-row-gray-300 align-middle gy-2">
                                <tbody>
                                    <tr>
                                        <td class="fw-bolder">Parameters</td>
                                        <td class="fw-bolder">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>add</td>
                                    </tr>
                                    <tr>
                                        <td>service</td>
                                        <td>Service ID</td>
                                    </tr>
                                    <tr>
                                        <td>link</td>
                                        <td>Link to page</td>
                                    </tr>
                                    <tr class="options default special special1">
                                        <td>quantity</td>
                                        <td>Needed quantity</td>
                                    </tr>
                                    <tr class="options special" style="display: none;">
                                        <td>list</td>
                                        <td>Suggest video list or Keyword search list</td>
                                    </tr>
                                    <tr class="options special1" style="display: none;">
                                        <td>suggest</td>
                                        <td>Suggest video list</td>
                                    </tr>
                                    <tr class="options special1" style="display: none;">
                                        <td>search</td>
                                        <td>Keyword search list</td>
                                    </tr>
                                    <tr class="options custom-comments" style="display: none;">
                                        <td>comments</td>
                                        <td>Comment list separated by \n</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6>Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html">{
    "order": 99999
}
</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="status">
                            <table class="table table-row-bordered table-row-gray-300 align-middle gy-2">
                                <tbody>
                                    <tr>
                                        <td class="fw-bolder">Parameters</td>
                                        <td class="fw-bolder">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>status</td>
                                    </tr>
                                    <tr>
                                        <td>order</td>
                                        <td>Order ID</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6>Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html">{
    "charge": "2.5",
    "start_count": "168",
    "status": "Success",
    "remains": "-2"
}
</pre>
                            </div>
                            <p><strong>Status</strong>: <em>Pending, Processing, In progress, Completed, Partial, Canceled</em></p>
                        </div>

                        <div class="tab-pane fade" id="multistatus">
                            <table class="table table-row-bordered table-row-gray-300 align-middle gy-2">
                                <tbody>
                                    <tr>
                                        <td class="fw-bolder">Parameters</td>
                                        <td class="fw-bolder">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>status</td>
                                    </tr>
                                    <tr>
                                        <td>orders</td>
                                        <td>Order IDs separated by comma (E.g: 123,456,789)</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6>Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html">{
    "123": {
        "charge": "0.27819",
        "start_count": "3572",
        "status": "Partial",
        "remains": "157"
    },
    "456": {
        "error": "Incorrect order ID"
    },
    "789": {
        "charge": "1.44219",
        "start_count": "234",
        "status": "In progress",
        "remains": "10"
    }
}
</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="balance">
                            <table class="table table-row-bordered table-row-gray-300 align-middle gy-2">
                                <tbody>
                                    <tr>
                                        <td class="fw-bolder">Parameters</td>
                                        <td class="fw-bolder">Description</td>
                                    </tr>
                                    <tr>
                                        <td>key</td>
                                        <td>API Key </td>
                                    </tr>
                                    <tr>
                                        <td>action</td>
                                        <td>balance</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6>Example response</h6>
                            <div class="bg-light p-3">
                                <pre class="language-html">{
    "balance": "68.6868",
    "currency": "USD"
}
</pre>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="phpcode">
                            <a href="code.txt" class="btn btn-primary"><i class="fas fa-code"></i> Example PHP Code</a>
                        </div>
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end: Card Body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    
@endsection