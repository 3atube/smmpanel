@extends('frontend.layouts.app')
@section('scriptFooter')
    <style>
        .card .card-header{
            min-height: 40px;
            background: #ddd;
            color: #000;
            line-height: 40px;
        }

    </style>
@endsection
@section('content')
    <!--end::Header-->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card mb-5 mb-xl-10">
                <div class="card-body p-0 div-services">
                    <div class="row pt-9 px-9">
                        @if (@count($items)>0)
                            @foreach ($items as $item)
                                <div class="col-sm-11">
                                    <div class="card">
                                        <div class="card-header"><b>{{ $item->user ? $item->user->name : '' }}</b></div>
                                        <div class="card-body">
                                            @for ($i = 0; $i < 5; $i++)
                                                @php $active = $item->user_rating > $i ? 'text-warning' : '' @endphp
                                                <i class="fas fa-star {{ $active }} mr-1"></i>
                                            @endfor
                                            <br>{!! $item->user_review !!}
                                        </div>
                                        <div class="card-footer text-right">{!! $item->created_at !!}</div>
                                    </div>
                                </div>
                            @endforeach
                            @else
                            <h4>No reviews</h4>
                            <br>
                            <br>
                        @endif
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
