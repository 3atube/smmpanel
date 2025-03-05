@extends('frontend.layouts.app')
@section('content')

<div class="content d-flex flex-column flex-column-fluid">
   @if(count($items)>0)

   <!--begin::Container-->
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-3   pt-5 pb-5">
            @php $col = 0; $numcols = 50; $ct=0; @endphp
            @for($i=0;$i<count($items);$i++) @if($ct && $ct%$numcols==0) </div>
               <div class="col-lg-3   pt-5 pb-5">
                  @endif
                  @php $item = $items[$i]; @endphp
                  @if($item->order_id!=0)
                  <div class="d-flex align-items-center mb-2 ">
                     <!--begin::Description-->
                     <div class="flex-grow-1 ">
                        <a href="cashflow?id={{$item->order_id}}" class="text-gray-800 text-hover-primary fw-bolder fs-6">#{{$item->order_id}}: {{$item->type}}</a>
                        <span class="text-muted d-block fs-8">{{$item->created_at}}</span>
                     </div>
                     <!--end::Description-->
                     <div>
                        <span class="d-flex flex-row-reverse fs-6 fw-bolder {{$item->type=='Add order' ? 'text-danger' : 'text-primary'}}">{{$item->cash}}</span>
                        <span class="d-flex flex-row-reverse text-muted fs-8 fw-bold d-block">{{$item->total_cash}}</span>
                     </div>
                  </div>
                  @else
                  <div class="d-flex align-items-center mb-2 ">
                     <span class="bullet bullet-vertical h-40px bg-primary"></span>
                     <!--begin::Description-->
                     <div class="flex-grow-1 mx-3">
                        <span class="text-gray-800 fw-bolder fs-6">{{$item->type}}</span>
                        <span class="text-muted d-block fs-8">{{$item->created_at}}</span>
                     </div>
                     <!--end::Description-->
                     <div>
                        <span class="d-flex flex-row-reverse fs-6 fw-bolder text-primary">{{$item->cash}}</span>
                        <span class="d-flex flex-row-reverse text-muted fs-8 fw-bold d-block">{{$item->total_cash}}</span>
                     </div>
                  </div>
                  @endif
                  @php $ct++; @endphp
                  @endfor
               </div>
         </div>
         {{ $items->links() }}
      </div>
      <!--end::Container-->
      @endif

   </div>

   @endsection