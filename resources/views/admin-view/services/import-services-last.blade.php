<div class="majer">
    <div>
        <div class="services-import__fields">
            <div class="services-import__step3-field">
                <div class="services-import__placeholder-title">fixed (1.00)</div>
                <input type="number" placeholder="0" id="raise-fixed" name="fixed" value="">
            </div>
            <div class="services-import__step3-plus">+</div>
            <div class="services-import__step3-field">
                <div class="services-import__placeholder-title">Percent(%)</div>
                <input type="number" placeholder="0" id="raise-percent" name="percent" value="">
            </div>
            <div class="services-import__step3-actions"><span class="btn btn-default">Reset Calculations</span></div>
        </div>

        <div class="services-import__list-wrap services-import__list-active">
            <div class="services-import__scroll-wrap">
                @php $category_id = 0;$c = 0; @endphp
                @if(!empty($grouped))
                @foreach($grouped as $category)
                @php
                foreach ($apiServices as $key => $value) {
                if ($category[$category_id]['id'] == $value->service) {
                $categoryName = $value->category;
                break;
                }
                }
                $category_id = $category_id++;
                $c++;
                @endphp
                <span class="providerCategory" id="providerCategory-1">
                    <div class="services-import__category">
                        <div class="services-import__category-title"><label>{{$categoryName}}</label></div>
                    </div>
                    <div class="services-import__packages">
                        <ul>
                            @php
                            for ($i = 0; $i < count($category); $i++) { foreach ($apiServices as $apiService) { if ($apiService->service == $category[$i]['id']) {
                                @endphp
                                <li id="providerService-{{$apiService->service}}">
                                    <label class="row">
                                        <div class="col-md-8">{{$apiService->service}} - {{$apiService->name}}</div>
                                        <div class="col-md-3">
                                            <input style="
                                                        width: 85px;
                                                        border: solid 1px rgba(103,107,118,.5);
                                                        padding-left: 0;
                                                        padding-right: 22px;
                                                        border-radius: 3px;
                                                        background: 0 0;
                                                        " id="servicePriceCal{{$apiService->service}}" type="text" class="services-import__price" data-rate="{{$apiService->rate}}" data-service="{{$apiService->service}}" name="servicesList[{{$apiService->service}}]" value="{{$apiService->rate}}">
                                            <div class="services-import__packages-price-lock" data-category="{{$c}}" data-id="servicedelete-{{$apiService->service}}" data-service="{{$apiService->service}}">
                                                <span class="fa fa-trash"></span>
                                            </div>
                                            <div class="services-import__packages-price-lock" data-id="servicelock-{{$apiService->service}}" data-service="{{$apiService->service}}">
                                                <span class="fa fa-unlock"></span>
                                            </div>
                                        </div>
                                        <span class="services-import__provider-price">{{$apiService->rate}}</span>
                                    </label>
                                </li>
                                @php }}} @endphp
                        </ul>
                    </div>
                </span>
                @endforeach
                @else
                Chưa có dữ liệu
                @endif
            </div>
        </div>
    </div>
</div>
<script>
    function formatCurrency(total) {
        var neg = false;
        if (total < 0) {
            neg = true;
            total = Math.abs(total);
        }
        return parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
    }

    function sum(input) {
        if (toString.call(input) !== "[object Array]")
            return false;

        var total = 0;
        for (var i = 0; i < input.length; i++) {
            if (isNaN(input[i])) {
                continue;
            }
            total += Number(input[i]);
        }
        return total;
    }

    function chargeService() {
        var add_fixed = $("#raise-fixed").val();
        var add_percent = $("#raise-percent").val();
        $(".services-import__price").each(function() {
            if ($(this).attr("readonly") != "readonly") {
                var rate = $(this).attr("data-rate");
                var service = $(this).attr("data-service");
                var total = sum([rate, (rate * add_percent / 100), add_fixed]);
                $("#servicePriceCal" + service).val(total);

            }
        });
    }
    $('[data-id^="servicedelete-"]').click(function() {
        var id = $(this).attr("data-service");
        var category = $(this).attr("data-category");
        $("li#providerService-" + id).remove();
        if ($("#providerCategory-" + category + " > .services-import__packages > ul > li").length == 0) {
            $("#providerCategory-" + category).remove();
        }
    });
    $('[data-id^="servicelock-"]').click(function() {
        var service_id = $(this).attr("data-service");
        var lock = $(this).find("span").attr("class");
        if (lock == "fa fa-unlock") {
            $(this).find("span").removeClass("fa fa-unlock");
            $(this).find("span").addClass("fa fa-lock");
            $('[data-service="' + service_id + '"]').attr("readonly", true);
        } else {
            $(this).find("span").removeClass("fa fa-lock");
            $(this).find("span").addClass("fa fa-unlock");
            $('[data-service="' + service_id + '"]').attr("readonly", false);
        }
    });

    $(".services-import__step3-actions").click(function() {
        var add_fixed = $("#raise-fixed").val("");
        var add_percent = $("#raise-percent").val("");
        $(".services-import__price").each(function() {
            if ($(this).attr("readonly") != "readonly") {
                var rate = $(this).attr("data-rate");
                var service = $(this).attr("data-service");
                $("#servicePriceCal" + service).val(rate);
            }
        });
    });

    $("#raise-fixed").on("keyup", function() {
        chargeService();
    });

    $("#raise-percent").on("keyup", function() {
        chargeService();
    });
</script>