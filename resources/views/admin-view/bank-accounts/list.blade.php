@extends('admin-view.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="settings-header__table">
                <button type="button" class="btn btn-default m-b" data-toggle="modal" data-target="#modalDiv" data-action="new_bankaccount">New Bank Account</button>
                <div style="float:right;">
                    <a href="/admin/settings/payment-methods" class="details_backButton btn btn-link"><span>‹</span> Back</a>
                </div>


            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            Content
                        </th>
                        <!-- <th>
                            Recipient Name
                        </th> -->
                        <th>
                            Vị trí
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="methods-sortable ui-sortable">
                    @if(count($items))
                    @foreach($items as $item)
                    <tr>
                        <td>
                            {!!$item->bank_content!!} </td>
                        <td>{{$item->line}} </td> 
                        <td class="p-r">
                            <button type="button" class="btn btn-default btn-xs pull-right edit-payment-method" data-toggle="modal" data-target="#modalDiv" data-action="edit_bankaccount" data-id="{{$item->id}}">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr><td colspan="4">Chưa có dữ liệu</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection