@extends('admin-view.layouts.app')
@section('content')
<style>
  .btn-link{
    color: #333;
    padding-left: 20px;
  }
</style>
    <div class="container-fluid">
        <ul class="nav nav-tabs nav-tabs__service">
            <li class="p-b"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#modalDiv"
                    data-action="new_admin">NEW ADMIN</button></li>
            <li class="pull-right p-b">
                <form class="form-inline" action="" method="get" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request()->search }}"
                            placeholder="Search for Users...">
                        <span class="input-group-btn search-select-wrap">
                            <select class="form-control search-select" name="search_type">
                                @php $array = [
                                        'username' => 'USERNAME',
                                        'email' => 'EMAIL',
                                ]; @endphp
                                @foreach ($array as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ $key == request()->search_type ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-default"><span class="fa fa-search"
                                    aria-hidden="true"></span></button>
                        </span>
                    </div>
                </form>
            </li>
            <!-- <li class="pull-right p-b"><a data-toggle="modal" data-target="#modalDiv" data-action="export_user">EXPORT USER</a></li> -->
        </ul>
        <table class="table">
            <thead>
                <tr>
                    <th class="column-id">ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th nowrap="">Last Entry</th>
                    <th>Custom Rate</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (count($items) > 0)
                    @foreach ($items as $item)
                        <tr class="{{ $item->user_type == 1 ? 'grey' : '' }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td class="td-caret">
                                <div class="dropdown pull-right">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret"
                                        data-toggle="dropdown">Transactions <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv"
                                                data-action="edit_admin" data-id="{{ $item->id }}">Edit User</a></li>
                                        <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv"
                                                data-action="pass_admin" data-id="{{ $item->id }}">Change Password</a>
                                        </li>
                                        <a id="delete-row" data-url="{{ route('admin.user.remove', $item->id) }}"
                                            class="btn btn-link deactivate-integration-btn">Delete</a>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        @php $links = $items->withQueryString()->links('pagination::bootstrap-4') @endphp
        {!!$links!!}
    </div>
@endsection
