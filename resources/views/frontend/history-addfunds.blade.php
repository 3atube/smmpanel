@if(count($items))
@foreach($items as $item)
<tr>
    <td>{{$item->payment_methods ? $item->payment_methods->method_name : ""}}</td>
    <td>{{$item->payment_amount}}</td>
    <td>{{$item->payment_note}}</td>
    <td>{{\App\Libraries\Helpers::getStatusPayment($item->payment_status)}}</td>
    <td>{{$item->created_at}}</td>
</tr>
@endforeach
@else
<tr>
    <td colspan="4">Chưa có dữ liệu</td>
</tr>
@endif