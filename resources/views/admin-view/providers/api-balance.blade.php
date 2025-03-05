<div class="form-group">
    <table class="table providers_list">
        <thead>
            <tr>
                <th class="p-l" width="45%">Provider</th>
                <th>Balance</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if(count($items)>0)
            @foreach($items as $item)
            @if(!$check)
            @php \App\Libraries\Helpers::getBalance($item); 
            // \App\Libraries\Helpers::checkLoginSubSMM($item);
            @endphp
            <tr class="{{$item->currency ? 'list_item ':'grey'}} ">
                <td class="name p-l">{!!$item->api_name!!}</td>
                <td>{!!$item->currency ? $item->balance.' '.$item->currency:'<i class="fas fa-question-circle"></i>'!!} </td>
                <td class="p-r">
                    <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#modalDiv" data-action="edit_provider" data-id="{{$item->id}}">Edit</button>
                </td>
                <input type="hidden" name="privder_changes" value="privder_changes">
            </tr>
            @else
            <tr class="grey">
                <td class="name p-l">{{$item->api_name}}</td>
                <td> <i class="fas fa-spinner fa-spin"> </td>
                <td class="p-r">
                    <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#modalDiv" data-action="edit_provider" data-id="{{$item->id}}">Edit</button>
                </td>
                <input type="hidden" name="privder_changes" value="privder_changes">
            </tr>
            @endif
            @endforeach
            @else
            <tr class="grey">
                <td colspan="3"><b>Chưa có dữ liệu</b></td>
            </tr>
            @endif
        </tbody>
    </table>
</div>