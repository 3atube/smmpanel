@extends('admin-view.layouts.app')

@section('content')<div class="container">
    <div class="row">
        @include('admin-view.left-sidebar')
        <div class="col-md-8">
            @if(session('refill'))
            <div class="alert alert-danger ">{!!session('refill')!!}</div>
            @endif
            <ul class="nav nav-tabs">
                <li class="p-b"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalDiv" data-action="new_language">Create New</button></li>
            </ul>
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Key</th>
                        <th>Value</th>
                        <th class="dropdown-th"></th>
                    </tr>
                </thead>
                @if(!empty($items))

                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td class="p-l">
                            {{$item->id}}
                        </td>
                        <td>
                            {{$item->language_key}}
                        </td>
                        <td>{{$item->language_value }}</td>
                        <td class="service-block__action">
                            <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#modalDiv" data-action="edit_language" data-id="{{$item->id}}">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">Chưa có dữ liệu</td>
                    </tr>
                    @endif
                </tbody>
                {{ @$items->links() }}

                <input type="hidden" name="bulkStatus" id="bulkStatus" value="0" />
            </table>
        </div>
    </div>
</div>

@endsection