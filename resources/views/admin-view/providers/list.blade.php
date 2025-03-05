@extends('admin-view.layouts.app')
@section('scripts')
<script>
    $(function() {
        $.ajax({
            url: "{{route('admin.api_balance')}}?q=1",
            type: 'GET',
            success: function(result) {
                $('.balance').html(result);
            }
        });
    });

    $(".providers").html('<div class="balance"></div>');

    $(function() {
        $.ajax({
            url: "{{route('admin.api_balance')}}",
            type: 'GET',
            success: function(result) {
                $('.providers').html(result);
            }
        });
    });
</script> @endsection
@section('content')
<div class="container">
    <div class="row">
        @include('admin-view.left-sidebar')
        <div class="col-md-8">
            <div class="settings-header__table">
                <button type="button" class="btn btn-default m-b" data-toggle="modal" data-target="#modalDiv" data-action="new_provider">Add New Provider</button>
            </div>
            <div class="providers">
                <div class="balance"></div>
            </div>

        </div>
    </div>

    @endsection