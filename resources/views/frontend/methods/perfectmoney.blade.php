<div class="div-pm div-10">
    <form action="https://perfectmoney.is/api/step1.asp" method="POST">
        @php $method_extras = json_decode($info->method_extras); @endphp

        <div class="mb-5">
            <label class="required form-label">Enter amount to deposit</label>
            <input type="number" name="PAYMENT_AMOUNT" min="{{!empty($method_extras->min) ? $method_extras->min : 10 }}"  value="{{!empty($method_extras->min) ? $method_extras->min : 10 }}" class="form-control">
        </div>
        @if(!empty($method_extras->pm_marchanid) && !empty($method_extras->pm_marchant_name))
        <input type="hidden" name="PAYEE_ACCOUNT" value="{{$method_extras->pm_marchanid}}">
        <input type="hidden" name="PAYEE_NAME" value="{{$method_extras->pm_marchant_name}}">
        @else
        <input type="hidden" name="PAYEE_ACCOUNT" value="{{env('PM_MARCHANTID')}}">
        <input type="hidden" name="PAYEE_NAME" value="{{env('PM_MARCHANT_NAME')}}">
        @endif
        <input type="hidden" name="PAYMENT_UNITS" value="USD">
        <input type="hidden" name="STATUS_URL" value="{{route('perfectmoney.status')}}">
        <input type="hidden" name="PAYMENT_URL" value="{{route('perfectmoney.success')}}">
        <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
        <input type="hidden" name="NOPAYMENT_URL" value="{{route('perfectmoney.fail')}}">
        <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
        <input type="hidden" name="SUGGESTED_MEMO" value="Add funds ({{Auth::user()->name}})">
        <input type="hidden" name="ACCOUNT_ID" value="{{Auth::user()->id}}">
        <input type="hidden" name="BAGGAGE_FIELDS" value="ACCOUNT_ID">
        <input type="submit" name="PAYMENT_METHOD" class="btn btn-primary w-100" value="Pay Now!">
    </form>
</div>