@extends('frontend.layouts.app')
@section('scriptFooter')
 <script>
        typeof _services !== 'undefined' && _services.init();
    </script>
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid">
	<!--begin::Container-->
	<div class="container-fluid">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card body-->
            <div class="card-body p-0 div-services">
                <div class="d-flex justify-content-end bd-highlight p-9">
                    <div><input type="text" class="form-control" placeholder="Search" onkeyup="_services._on.keyup.filter(this.value)"/></div>
                </div>
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered fs-7 gy-3 gs-9">
						<thead class="fs-6 fw-bold bg-lighten">
                            <tr>
                                <th>Name</th>
                                <th>Rate</th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <!--end::Thead-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table wrapper-->
            </div>
            <!--end::Card body-->
            <div class="modal fade" id="modal-detail" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bolder"></h2>
                            <!--end::Modal title-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y"></div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
        </div>
	</div>
	<!--end::Container-->
</div>
@endsection