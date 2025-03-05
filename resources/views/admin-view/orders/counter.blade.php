<li class="active">
    <a href="/admin/orders/all">All Orders ({{$count}})</a>
</li>
@if(count($items))
@foreach($items as $item)
<li>
    <a style="color: #c1c1c1;" href="admin/orders/?service_id={{$item->id}}"><span class="label-id">{{$item->id}}</span> {{$item->service_name}}</a>
</li>
@endforeach
@endif