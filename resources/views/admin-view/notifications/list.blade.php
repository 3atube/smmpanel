@extends('admin-view.layouts.app')

@section('content')<div class="container">
    <div class="row">
        @include('admin-view.left-sidebar')
        <div class="col-md-8">
            @if(session('error'))
            <div class="alert alert-danger ">{!!session('error')!!}</div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">{!!session('success')!!}</div>
            @endif
            <ul class="nav nav-tabs">
                <li class="p-b"><a type="button" style="border: 1px solid #ddd" class="btn btn-default" href="{{route('admin.notifications.addView')}}">Create New</a></li>
            </ul>
            <table class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Status</th>
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
                            {{$item->title}}
                        </td>
                        <td>{!!$item->content !!}</td>
                        <td class="capitalize">{!!$item->status !!}</td>
                        <td class="service-block__action">
                            <a type="button" class="btn btn-default btn-xs pull-right" href="{{route('admin.notifications.edit', $item->id)}}">Edit</a>
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
<style>
    .capitalize{
        text-transform: capitalize;
    }
</style>
@endsection