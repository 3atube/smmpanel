@extends('admin-view.layouts.app')

@section('content')
<div class="container main-wrapper">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="yw0" action="{{route('admin.changePass')}}" method="post">
                      @csrf
                      @foreach ($errors->all() as $error)
                          <div class="error-msg" style="color: red; margin-bottom: 10px">{{ $error }}</div>
                      @endforeach
                        <div id="AccountFormErrors" class="error-summary alert alert-danger hidden"></div>
                        <div class="form-group field-accountform-current_password required">
                            <label class="control-label" for="accountform-current_password">Current password</label>
                            <input type="password" id="accountform-current_password" class="form-control"
                                name="current_password" value="" aria-required="true">
                        </div>
                        <div class="form-group field-accountform-new_password required">
                            <label class="control-label" for="accountform-new_password">New password</label>
                            <input type="password" id="accountform-new_password" class="form-control"
                                name="new_password" value="" aria-required="true">
                        </div>
                        <div class="form-group field-accountform-confirm_password required">
                            <label class="control-label" for="accountform-confirm_password">Confirm password</label>
                            <input type="password" id="accountform-confirm_password" class="form-control"
                                name="confirm_password" value="" aria-required="true">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Change password</button>
                        <div class="modal-loader hidden"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection