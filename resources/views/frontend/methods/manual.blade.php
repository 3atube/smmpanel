@if (!empty($items))
    @foreach (@$items as $item)
        <div class="div-pm div-2 text-left" style="">
            <div>
                <br>
                {!! \App\Libraries\Helpers::getHtmlContent($item->bank_content) !!}
            </div>
        </div>
    @endforeach
@endif
@php $payment = Helpers::infoManualPayment(); $methodExtras = json_decode($payment->method_extras); @endphp
<div class="div-pm div-2 text-center">
    <div class="images">
        <div class="info">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6>Tên ngân hàng:</h6>
                </div>
                <div class="col">
                    <h5><strong>{{$methodExtras->secret_key}}</strong></h5>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h6>Số TK:</h6>
                </div>
                <div class="col">
                    <h5><strong>{{$methodExtras->merchant_key}}</strong></h5>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h6>Tên TK:</h6>
                </div>
                <div class="col">
                    <h5><strong>{{$methodExtras->name}}</strong></h5>
                </div>
            </div>
        </div>
        <img style="width: 300px"
            src="https://img.vietqr.io/image/{{strtolower($methodExtras->secret_key)}}-{{$methodExtras->merchant_key}}-qr_only.png?accountName={{$methodExtras->name}}&amp;addInfo={{$methodExtras->merchant_website}} {{ Auth::user()->name }}">
    </div>
    <div>
        <u>Nội dung</u>: <span class="fs-6 info" id="info_vtb">{{$methodExtras->merchant_website}}
            {{ Auth::user()->name }}</span>
        <button class="btn btn-icon btn-sm btn-light w-30px h-30px" data-clipboard-target="#info_vtb">
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"
                    fill="none">
                    <path opacity="0.5"
                        d="M18 2H9C7.34315 2 6 3.34315 6 5H8C8 4.44772 8.44772 4 9 4H18C18.5523 4 19 4.44772 19 5V16C19 16.5523 18.5523 17 18 17V19C19.6569 19 21 17.6569 21 16V5C21 3.34315 19.6569 2 18 2Z"
                        fill="currentColor"></path>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M14.7857 7.125H6.21429C5.62255 7.125 5.14286 7.6007 5.14286 8.1875V18.8125C5.14286 19.3993 5.62255 19.875 6.21429 19.875H14.7857C15.3774 19.875 15.8571 19.3993 15.8571 18.8125V8.1875C15.8571 7.6007 15.3774 7.125 14.7857 7.125ZM6.21429 5C4.43908 5 3 6.42709 3 8.1875V18.8125C3 20.5729 4.43909 22 6.21429 22H14.7857C16.5609 22 18 20.5729 18 18.8125V8.1875C18 6.42709 16.5609 5 14.7857 5H6.21429Z"
                        fill="currentColor"></path>
                </svg>
            </span>
        </button>
    </div>
    <div>
        {!!$payment->method_content!!}
    </div>
</div>
<style>
    .info img {
        width: 100%;
        transform: scale(1.2);
    }

    .info {
        width: 300px;
        margin: 0 auto;
        padding-bottom: 6px;
    }
</style>
