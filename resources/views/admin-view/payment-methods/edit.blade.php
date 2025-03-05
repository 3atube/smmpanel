<form class="form" action="{{route('admin.payment-methods-edit',[$info->method_get])}}" method="post" data-xhr="true">
  @csrf
  <input type="hidden" name="_method" value="PUT">
  <div class="modal-body">

    <div class="form-group">
      <label class="form-group__service-name">Method name</label>
      <input type="text" class="form-control" readonly="" value="{{$info->method_name}}">
    </div>

    <div class="service-mode__block">
      <div class="form-group">
        <label>Visibility</label>
        <select class="form-control" name="method_type">
          @php $arr = [2=>'Active',1=>'Passive'] @endphp
          @foreach($arr as $key => $value)
          <option value="{{$key}}" {{$key==$info->method_type ? 'selected=""' : ''}} >{{$value}}</option>
          @endforeach
        </select>
      </div>
    </div>
    @php $methodExtras = json_decode($info->method_extras);@endphp
    <div class="form-group">
      <label class="form-group__service-name">{{$info->method_get === 'manual' ? 'Tên tài khoản' : 'visible name'}}</label>
      <input type="text" class="form-control" name="name"
        value="{{!empty($methodExtras->name) ? $methodExtras->name : ''}}">
    </div>

    <div class="form-group">
      <label class="form-group__service-name">Minimum Payment</label>
      <input type="text" class="form-control" name="min"
        value="{{!empty($methodExtras->min) ? $methodExtras->min : ''}}">
    </div>

    <div class="form-group">
      <label class="form-group__service-name">Maximum Payout</label>
      <input type="text" class="form-control" name="max"
        value="{{!empty($methodExtras->max) ? $methodExtras->max : ''}}">
    </div>

    <hr>
    <p class="card-description">
      @if($info->method_get=='payeer')
      <p>Status URL: {{route('payeer.status')}}</p>
      <p>Success URL: {{route('payeer.success')}}</p>
      <p>Fail URL: {{route('payeer.fail')}}</p>
      @endif
    </p>
    
   
    <hr>

   
    <div class="form-group">
      <label class="form-group__service-name">{{$info->method_get === 'manual' ? 'Số tài khoản' : 'Merchant Key'}}</label>
      <input type="text" class="form-control" name="merchant_key"
        value="{{!empty($methodExtras->merchant_key) ? $methodExtras->merchant_key : ''}}">
    </div>
    <div class="form-group">
      <label class="form-group__service-name"> {{$info->method_get === 'manual' ? 'Tên ngân hàng' : 'Secret Key'}}</label>
      <input type="text" class="form-control" name="secret_key"
        value="{{!empty($methodExtras->secret_key) ? $methodExtras->secret_key : ''}}">
    </div>
    
    @if($info->method_get=='perfectmoney')
    <div class="form-group">
      <label class="form-group__service-name">PM_MARCHANTID</label>
      <input type="text" class="form-control" name="pm_marchanid"
        value="{{!empty($methodExtras->pm_marchanid) ? $methodExtras->pm_marchanid : ''}}">
    </div>
    <div class="form-group">
      <label class="form-group__service-name">PM_MARCHANT_NAME</label>
      <input type="text" class="form-control" name="pm_marchant_name"
        value="{{!empty($methodExtras->pm_marchant_name) ? $methodExtras->pm_marchant_name : ''}}">
    </div>
    @endif
    @if($info->method_get=='paypal')
    <div class="form-group">
      <label class="form-group__service-name">PAYPAL_CLIENT_ID</label>
      <input type="text" class="form-control" name="paypal_client_id"
        value="{{!empty($methodExtras->paypal_client_id) ? $methodExtras->paypal_client_id : ''}}">
    </div>
    <div class="form-group">
      <label class="form-group__service-name">PAYPAL_SECRET</label>
      <input type="text" class="form-control" name="paypal_secret"
        value="{{!empty($methodExtras->paypal_secret) ? $methodExtras->paypal_secret : ''}}">
    </div>
    <div class="form-group">
      <label class="form-group__service-name"><a target="_blank" href="https://viblo.asia/p/them-chuc-nang-thanh-toan-paypal-cho-website-cua-ban-m68Z0AGzlkG">https://viblo.asia/p/them-chuc-nang-thanh-toan-paypal-cho-website-cua-ban-m68Z0AGzlkG</a></label>
    
    </div>
    
    @endif
    
    <div class="form-group">
      <label class="form-group__service-name">{{$info->method_get === 'manual' ? 'Format Chuyển khoản' : 'Merchant Website'}}</label>
      <input type="text" class="form-control" name="merchant_website"
        value="{{!empty($methodExtras->merchant_website) ? $methodExtras->merchant_website : ''}}">
    </div>

    <div class="form-group">
      <label class="form-group__service-name">Currency</label>
      <input type="text" class="form-control" name="currency"
        value="{{!empty($methodExtras->currency) ? $methodExtras->currency : 'USD'}}" readonly="">
    </div>

    <div class="form-group">
      <label class="form-group__service-name">Commission, %</label>
      <input type="text" class="form-control" name="fee"
        value="{{!empty($methodExtras->fee) ? $methodExtras->fee : ''}}">
    </div>

  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Update Settings</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</form>