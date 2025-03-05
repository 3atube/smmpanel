<form class="form" action="{{route('admin.edit-service',[$info->id])}}" method="post" data-xhr="true">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="current" value="{{Request->current()}}">
    <div class="modal-body">
        <div class="form-group">
            <label class="form-group__service-name">Service name</label>
            <input type="text" class="form-control" name="name" value="{{$info->service_name}}">
        </div>
        <div class="service-mode__block">
            <div class="form-group">
                <label>Service Category</label>
                <select class="form-control" name="category">
                    <option value="">Please select category..</option>
                    @if(count($categories)>0)
                    @foreach($categories as $item)
                    <option value="{{$item->id}}" {{$info->category_id ==$item->id ? 'selected=""' : ''}}>{{$item->category_name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="service-mode__wrapper">
            <div class="service-mode__block">
                <div class="form-group">
                    <label>Service Type</label>
                    <select class="form-control" name="package">
                        @php $package = [1=>'Services', 2=>'Package', 3=>'Special Comment', 4=>'Package Comment'] @endphp
                        @foreach($package as $key => $value)
                        <option value="{{$key}}" {{$info->service_package == $key ? 'selected=""' : ''}} >{{$value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="service-mode__block">
                <div class="form-group">
                    <label>Mode</label>
                    <select class="form-control" name="mode" id="serviceMode">
                    @php $mode = [1=>'Manuel', 2=>'Automatic (API)'] @endphp
                    @foreach($mode as $key => $value)
                    <option value="{{$key}}" {{$info->mode == $key ? 'selected=""' : ''}} >{{$value}}</option>
                    @endforeach
                   
                    </select>
                </div>
            </div>
            <div id="autoMode" style="">
                <div class="service-mode__block">
                    <div class="form-group">
                        <label>Service Provider</label>
                        <select class="form-control" name="provider" id="provider">
                            <option value="0">Select service provider...</option>
                            @if(count($providers)>0)
                            @foreach($providers as $item)
                            <option value="{{$item->id}}" {{$info->service_api == $item->id ? 'selected=""' : ''}}>{{$item->api_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div id="provider_service">
                    <div class="service-mode__block">
                        <div class="form-group">
                            <label>Services</label>
                            <select class="form-control" name="service">
                                @if(!empty($services))
                                @foreach($services as $item)
                                @php @endphp
                                <option value="{{$item->service}}" {{$item->service==$info->api_service ? 'selected=""' : ''}} >{{$item->service}} - {{$item->name}} - {{$item->rate}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="service-mode__block">
                    <div class="form-group">
                        <label>Dripfeed</label>
                        <select class="form-control" name="dripfeed">
                        @php $dripfeed = [1=>'Passive', 2=>'Active'] @endphp
                            @foreach($dripfeed as $key => $value)
                            <option value="{{$key}}" {{$info->service_dripfeed == $key ? 'selected=""' : ''}} >{{$value}}</option>
                            @endforeach
                          
                        </select>
                    </div>
                </div>
            </div>
        </div>

        @php $api_detail = json_decode($info->api_detail);
        @endphp
        @if(!empty($api_detail))
        <div class="form-group">
            <label class="form-group__service-name">1000 Quantity Fee</label>

            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" id="priceInput" name="price" value="{{$info->service_price}}" style="display: block;">
                    <div id="priceThreeInput" style="display: none;">
                        <div class="col-md-6">
                            <input type="text" class="form-control" style="border-radius:5px;" id="priceInput" name="sync_rate" value="0">
                        </div>
                        <div class="col-md-6">

                            <div class="input-group">
                                <span class="input-group-addon">USD</span>
                                <input type="text" value="{{$info->service_price}}" readonly="" class=" form-control" placeholder="MajerPanel">

                                <span class="input-group-addon">{{$api_detail->rate}}</span>

                            </div>


                            <input type="hidden" name="price_api" value="{{$api_detail->rate}}">

                        </div>

                    </div>

                    <div class="input-group-addon">
                        <label class="switch"><input id="priceCheckbox" type="checkbox" name="auto_price">
                            <span class="slider round"></span>
                        </label>

                    </div>
                </div>
            </div>

        </div>
        @else
        <div class="form-group">
            <label class="form-group__service-name">Service price (1000 units)</label>
            <input type="text" class="form-control" name="price" value="{{$info->service_price}}">
        </div>
        @endif
        @if(!empty($api_detail))
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-group__service-name">Minimum order</label>

                <div id="minText" style="padding: 11px;margin-left: 4px;" class="form-group__provider-value">{{$api_detail->min}}</div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="number" id="minPriceInput" style="height:43px;" class="form-control" name="min" value="{{$info->service_min}}">
                        <div class="input-group-addon">
                            <label class="switch"><input id="minPriceCheckbox" type="checkbox" name="auto_min">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-6 form-group">
                <label class="form-group__service-name">Maximum order</label>

                <div id="maxText" style="padding: 11px;margin-left: 4px;" class="form-group__provider-value">{{$api_detail->max}}</div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="number" id="maxPriceInput" style="height:43px;" class="form-control" name="max" value="{{$info->service_max}}">
                        <div class="input-group-addon">
                            <label class="switch"><input id="maxPriceCheckbox" type="checkbox" name="auto_max">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-group__service-name">Minimum order</label>
                <input type="text" class="form-control" name="min" value="{{$info->service_min}}">
            </div>
            <div class="col-md-6 form-group">
                <label class="form-group__service-name">Maximum order</label>
                <input type="text" class="form-control" name="max" value="{{$info->service_max}}">
            </div>
        </div>
        @endif





        <hr>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Cancel button</label>
                <select class="form-control" name="cancel_type">
                @php $cancel_type = [2=>'Active', 1=>'Passive'] @endphp
                    @foreach($cancel_type as $key => $value)
                    <option value="{{$key}}" {{$info->cancel_type == $key ? 'selected=""' : ''}} >{{$value}}</option>
                    @endforeach
                   
                </select>
            </div>


            <div class="form-group col-md-6">
                <label>Refill button</label>
                <select class="form-control" id="refill" name="refill_type">
                @php $refill_type = [2=>'Active', 1=>'Passive'] @endphp
                    @foreach($refill_type as $key => $value)
                    <option value="{{$key}}" {{$info->refill_type == $key ? 'selected=""' : ''}} >{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="refill_day" class="form-group">
            <label>Refill Maximum Day <small>(If lifetime, write 0)</small></label>
            <input type="number" class="form-control" name="refill_time" value="0">
        </div>


        <hr>

        <div class="service-mode__block">
            <div class="form-group">
                <label>Order Link<small>(Shown on the new order page)</small></label>
                <select class="form-control" name="want_username">
                    @php $want_username = [1=>'Link', 2=>'Username'] @endphp
                    @foreach($want_username as $key => $value)
                    <option value="{{$key}}" {{$info->want_username == $key ? 'selected=""' : ''}} >{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="service-mode__block">
            <div class="form-group">
                <label>Personal Service <small>(Only the people you choose can see it)</small></label>
                <select class="form-control" name="secret">
                    @php $secret = [2=>'No', 1=>'Yes'] @endphp
                    @foreach($secret as $key => $value)
                    <option value="{{$key}}" {{$info->service_secret == $key ? 'selected=""' : ''}} >{{$value}}</option>
                    @endforeach
                    
                </select>
            </div>
        </div>

        <div class="service-mode__block">
            <div class="form-group">
                <label>Service Speed <small>(Displayed as symbol and color in the service list)</small></label>
                <select class="form-control" name="speed">
                    @php $speed = [1=>'Slow', 2=>'Sometimes Slow', 3=>'Normal', 4=>'Fast'] @endphp
                    @foreach($speed as $key => $value)
                    <option value="{{$key}}" {{$info->service_speed == $key ? 'selected=""' : ''}} >{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update service information</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
<script type="text/javascript">
    var type = $("#refill").val();
    if (type == 1) {
        $("#refill_day").hide();
    } else {
        $("#refill_day").show();
    }
    $("#refill").change(function() {
        var type = $(this).val();
        if (type == 1) {
            $("#refill_day").hide();
        } else {
            $("#refill_day").show();
        }
    });
    /* It is a minprice checkbox event. When it is clicked, the minpriceinput is readonly. When it is checked, the input remains open when it is not.*/
    $("#minPriceCheckbox").click(function() {
        var minPriceInput = $("#minPriceInput");
        var minText = $("#minText");
        if (!this.checked) {
            minPriceInput.removeAttr("readonly", "readonly");
        } else {
            minPriceInput.attr("readonly", "readonly");
            minPriceInput.val(minText.text());
        }
    });
    /* Maxprice is a checkbox event. When it is clicked, the minpriceinput is readonly. When it is checked, the input remains open when it is not checked. */
    $("#maxPriceCheckbox").click(function() {
        var maxPriceInput = $("#maxPriceInput");
        var maxText = $("#maxText");
        if (!this.checked) {
            maxPriceInput.removeAttr("readonly", "readonly");
        } else {
            maxPriceInput.attr("readonly", "readonly");
            maxPriceInput.val(maxText.text());
        }
    });
    /* Maxprice is a checkbox event. When it is clicked, the minpriceinput is readonly. When it is checked, the input remains open when it is not checked. */
    $("#priceCheckbox").click(function() {
        var priceInput = $("#priceInput");
        var priceThree = $("#priceThreeInput");
        if (this.checked) {
            priceInput.css("display", "none");
            priceThree.css("display", "block");
        } else {
            priceThree.css("display", "none");
            priceInput.css("display", "block");
        }
    });
    $(".other_services").click(function() {
        var control = $("#translationsList");
        if (control.attr("class") == "hidden") {
            control.removeClass("hidden");
        } else {
            control.addClass("hidden");
        }
    });
    var site_url = $("head base").attr("href");
    $("#provider").change(function() {
        var provider = $(this).val();
        getProviderServices(provider, site_url);
    });
    getProvider();
    $("#serviceMode").change(function() {
        getProvider();
    });
    getSalePrice();
    $("#saleprice_cal").change(function() {
        getSalePrice();
    });
    getSubscription();
    $("#subscription_package").change(function() {
        getSubscription();
    });
    function getProviderServices(provider, site_url) {
        if (provider == 0) {
            $("#provider_service").hide();
        } else {
            $.post(site_url + "admin/ajax_data", {
                action: "providers_list",
                provider: provider
            }).done(function(data) {
                $("#provider_service").show();
                $("#provider_service").html(data);
            }).fail(function() {
                alert("An error occurred!");
            });
        }
    }
    function getProvider() {
        var mode = $("#serviceMode").val();
        if (mode == 1) {
            $("#autoMode").hide();
        } else {
            $("#autoMode").show();
        }
    }
    function getSalePrice() {
        var type = $("#saleprice_cal").val();
        if (type == "normal") {
            $("#saleprice").hide();
            $("#servicePrice").show();
        } else {
            $("#saleprice").show();
            $("#servicePrice").hide();
        }
    }
    function getSubscription() {
        var type = $("#subscription_package").val();
        if (type == "11" || type == "12") {
            $("#unlimited").show();
            $("#limited").hide();
        } else {
            $("#unlimited").hide();
            $("#limited").show();
        }
    }
</script>
