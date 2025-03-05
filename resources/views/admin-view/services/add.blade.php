<form class="form" action="{{route('admin.new-service')}}" method="post" data-xhr="true">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label class="form-group__service-name">Service name </label>
            <input type="text" class="form-control" name="name" value="">
        </div>
        <div class="service-mode__block">
            <div class="form-group">
                <label>Service Category</label>
                <select class="form-control" name="category">
                    <option value="">Please select category..</option>
                    @if(count($categories)>0)
                    @foreach($categories as $item)
                    <option value="{{$item->id}}">{{$item->category_name}}</option>
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
                        <option value="1">Service</option>
                        <option value="2">Package</option>
                        <option value="3">Special Comment</option>
                        <option value="4">Package Comment</option>
                    </select>
                </div>
            </div>
            <div class="service-mode__block">
                <div class="form-group">
                    <label>Mode</label>
                    <select class="form-control" name="mode" id="serviceMode">
                        <option value="1">Manuel</option>
                        <option value="2">Automatic (API)</option>
                    </select>
                </div>
            </div>

            <div id="autoMode" style="display: none">
                <div class="service-mode__block">
                    <div class="form-group">
                        <label>Service Provider</label>
                        <select class="form-control" name="provider" id="provider">
                            <option value="">Select service provider...</option>
                            @if(count($providers)>0)
                            @foreach($providers as $item)
                            <option value="{{$item->id}}">{{$item->api_name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div id="provider_service">
                </div>
                <div class="service-mode__block">
                    <div class="form-group">
                        <label>Dripfeed</label>
                        <select class="form-control" name="dripfeed">
                            <option value="1">Passive</option>
                            <option value="2">Active</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group__service-name">1000 Quantity Fee</label>
            <input type="text" class="form-control" name="price" value="">
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-group__service-name">Minimum</label>
                <input type="text" class="form-control" name="min" value="">
            </div>

            <div class="col-md-6 form-group">
                <label class="form-group__service-name">Maximum</label>
                <input type="text" class="form-control" name="max" value="">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Cancel button</label>
                <select class="form-control" name="cancel_type">
                    <option value="2">Active</option>
                    <option value="1" selected="">Passive</option>
                </select>
            </div>


            <div class="form-group col-md-6">
                <label>Refill button</label>
                <select id="refill" class="form-control" name="refill_type">
                    <option value="2">Active</option>
                    <option value="1" selected="">Passive</option>
                </select>
            </div>
        </div>

        <div id="refill_day" class="form-group" style="display: none;">
            <label>Refill Maximum Day <small>(If lifetime, write 0)</small></label>
            <input type="number" class="form-control" name="refill_time">
        </div>


        <hr>

        <div class="service-mode__block">
            <div class="form-group">
                <label>Order Link<small>(Shown on the new order page)</small></label>
                <select class="form-control" name="want_username">
                    <option value="1">Link</option>
                    <option value="2">Username</option>
                </select>
            </div>
        </div>

        <div class="service-mode__block">
            <div class="form-group">
                <label>Personal Service <small>(Only the people you choose can see it)</small></label>
                <select class="form-control" name="secret">
                    <option value="2">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>

        <div class="service-mode__block">
            <div class="form-group">
                <label>Service Speed <small>(Displayed as symbol and color in the service list)</small></label>
                <select class="form-control" name="speed">
                    <option value="1">Slow</option>
                    <option value="2">Sometimes Slow</option>
                    <option value="3">Normal</option>
                    <option value="4">Fast</option>
                </select>
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add new service</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>