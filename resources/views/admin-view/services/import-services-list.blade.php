<div class="">
    <div class="majer">
        <div>
            <div class="services-import__list-wrap">
                <div class="services-import__scroll-wrap">
                    @if(count($grouped)>0)
                    @php $i = 0 @endphp
                    @foreach($grouped as $key => $group)
                    @php $i++ @endphp
                    <span>
                        <div class="services-import__category">
                            <div class="services-import__category-title">
                                <label><input type="checkbox" data-id="{{$i}}" id="checkAll-{{$i}}">{{$key}}

                                </label>
                                <input type="hidden" name="category" value="{{$category}}">
                            </div>
                        </div>
                        <div class="services-import__packages">
                            <ul>
                                @if(count($group)>0)
                                @foreach($group as $itemGroup) 
                                <li><label>
                                        <input data-service="{{$itemGroup->name}}" data-provider="{{$provider}}" data-category="{{$category}}" class="selectServices-{{$i}}" type="checkbox" value="{{$itemGroup->service}}" name="services[]">{{$itemGroup->service}} - {{$itemGroup->name}}<span class="services-import__packages-price">{{$itemGroup->rate}}</span></label></li>
                                        @endforeach
                               @endif
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
        $('[id^="checkAll-"]').click(function() {
            var id = $(this).attr("data-id");
            if ($(this).prop("checked") == true) {
                $(".selectServices-" + id).not(this).prop("checked", true);
            } else {
                $(".selectServices-" + id).not(this).prop("checked", false);
            }
        });
    </script>
</div>