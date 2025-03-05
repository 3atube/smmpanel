@extends('frontend.layouts.app')
@section('content')
    <!--end::Header-->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card body-->
                <div class="card-body p-0 div-services">
                    {{-- <div class="d-flex justify-content-end bd-highlight p-9">
                                    <div><input type="text" class="form-control" placeholder="Search"
                                            onkeyup="_services._on.keyup.filter(this.value)" /></div>
                                </div> --}}
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
                            <tbody class="tbody-9">
                                @if(count($items)>0)
                                @foreach($items as $item)
                                @php \App\Libraries\Helpers::updateCategoryLine($item->id, $item->category_line); @endphp
                                @php $services = \App\Libraries\Helpers::getServiceByCategoryId($item->id);
                                $countServiceByCategory = \App\Libraries\Helpers::countServiceByCategory($item->id);
                                @endphp

                                @if($countServiceByCategory>0)
                                <tr class="static {{count($services)}}">
                                    <td colspan="5" style="color: #fff" class="fw-boldest bg-secondary">{{$item->category_name}}</td>
                                </tr>
                                @endif
                                @if(count($services)>0)
                                @foreach($services as $service)
                                @if($service->service_type==2)
                                <tr>
                                    <td class="wrap">{{$service->id}} | {{$service->service_name}}</td>
                                    <td>{{$service->service_price}}</td>
                                    <td>{{$service->service_min}}</td>
                                    <td>{{$service->service_max}}</td>
                                    <td><button type="button" data-id="{{$service->id}}" class="details-service btn btn-secondary btn-sm px-3 py-2">Details</button> <a style="color: #fff" class="btn btn-primary btn-sm px-3 py-2" href="/order?cat={{$item->id}}&service={{$service->id}}">Buy</a></td>
                                </tr>
                                @endif
                                @endforeach
                                @endif
                                @endforeach
                                @endif



                            </tbody>
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
    <!--end::Content-->
    <!--begin::Footer-->
@endsection