@extends('frontend.layouts.app')
@section('content')
<div class="content d-flex flex-column flex-column-fluid">
   <!--begin::Container-->
   <div class="container-fluid" id="kt_content_container">
      <div class="row">
         <div class="col-lg-4 offset-lg-4">
            <div class="card mb-5">
               <!--begin::Card body-->
               <div class="card-body">
                  <!--begin::Item-->
                  @if(!empty($items))
                     @php $total = 0 @endphp
                     @foreach($items as $item)
                     @php $total = $item->type=='Canceled' ? 0 : $item->cash @endphp
                     <div class="d-flex align-items-center mb-2">
                        <!--begin::Description-->
                        <div class="flex-grow-1 ">
                           <a href="cashflow?id={{$item->order_id}}" class="text-gray-800 text-hover-primary fw-bolder fs-6">#{{$item->order_id}}: {{$item->type}}</a>
                           <span class="text-muted d-block fs-8">{{$item->created_at}}</span>
                        </div>
                        <!--end::Description-->
                        <div>
                           <span class="d-flex flex-row-reverse fs-6 fw-bolder {{$item->type=='Add order' ? 'text-danger' : 'text-primary'}} ">{{$item->cash}}</span>
                        </div>
                     </div>
                     @endforeach
                  @endif
                  <!--end:Item-->
                  <!--begin::Item-->
                  <div class="separator my-2"></div>
                  <div class="d-flex align-items-center mb-2">
                     <!--begin::Description-->
                     <div class="flex-grow-1">
                        <span class="text-gray-800 text-hover-primary fw-bolder fs-6">Total charge:</span>
                     </div>
                     <!--end::Description-->
                     <div class="text-center">
                        <span class="fs-6 fw-bolder text-danger">{{$total}}</span>
                     </div>
                  </div>
               </div>
               <!--end::Card body-->
            </div>
         </div>
      </div>
   </div>
   <!--end::Container-->
</div>
@endsection