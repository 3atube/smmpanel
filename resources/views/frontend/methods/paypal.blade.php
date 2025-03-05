<div class="div-pm div-10">
    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypal') !!}">
        {{ csrf_field() }}
        <div class="mb-5">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" value="{{Auth::user()->name}}" class="form-control" name="name">
            <label class="required form-label">Enter amount to deposit</label>
            @if(Auth::user()->id==3)
            <input type="number" value="{{!empty($method_extras->min) ? $method_extras->min : 1 }}" min="{{!empty($method_extras->min) ? $method_extras->min : 1 }}" class="form-control" name="money">
            @else
            <input type="number" value="{{!empty($method_extras->min) ? $method_extras->min : 10 }}" min="{{!empty($method_extras->min) ? $method_extras->min : 10 }}" class="form-control" name="money">
            @endif
        </div>
        <input type="submit" name="PAYMENT_METHOD" data-gateway="paypal" class="btn btn-primary w-100" value="Pay Now!">
    </form>
</div>