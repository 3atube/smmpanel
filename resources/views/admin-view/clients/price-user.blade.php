<form class="form" action="{{route('admin.client-edit-price', [$info->id])}}" method="post" data-xhr="true">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="modal-body">

        <div class="majer">
            <div>
                <div class="services-import__list-wrap services-import__list-active">
                    <div class="services-import__scroll-wrap">
                        <span>
                            <div class="services-import__packages">
                                <ul>
                                    @if(count($items))
                                    @foreach($items as $item)
                                    <li id="service-{{$item->serviceid}}">
                                        <label class="row" style="margin:0">
                                            <p class="col-md-8 col-xs-10" style="margin-top:5px;padding:0px;">
                                                <span class="label-id" style="margin-right:7px">{{$item->serviceid}}</span>{{$item->service_name}}
                                            </p>

                                            <span class="col-md-1 col-xs-2" style="margin-top:5px">{{$item->price}}</span>
                                            <span class="col-md-2 col-xs-10">
                                                <div class="input-group" style="width:100%">
                                                    <input type="text" style="border-radius:5px" class="form_field field_price form-control" name="price[{{$item->serviceid}}]" value="{{$item->clientprice}}">
                                                </div>
                                            </span>

                                            <div class="col-md-1 col-xs-2" style="text-align:right;font-size:17px;top:5;right:17px;" data-id="servicedelete-{{$item->serviceid}}" data-service="{{$item->serviceid}}">
                                                <span class="fa fa-trash"></span>
                                            </div>
                                        </label>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('[data-id^="servicedelete-"]').click(function() {
                var id = $(this).attr("data-service");
                $("[name='price[" + id + "]']").val("");
                //$("ul > li#service-"+id).remove();
            });
        </script>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Settings</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>