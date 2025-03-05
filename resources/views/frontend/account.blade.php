@extends('frontend.layouts.app')
@section('content')
    <div id="block_35">
        <div class="account ">
            <div class="bg"></div>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
											
											@if(session('status'))
											<div class="alert alert-dismissible alert-success mb-3 ">
													<button type="button" class="close" data-dismiss="alert">×</button>
													{!!session('status')!!}
											</div>
											@endif
                        <div class="component_card">
                            <div class="card account-card">
                                <div class="component_form_group">
                                    <div class="">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" id="username" value="{{Auth::user()->name}}"
                                                disabled="disabled">
                                        </div>
                                        <div class="component_button_save">
                                            <div class="form-group">
                                                <label for="email" class="control-label">Email</label>
                                                <input type="text" class="form-control" id="email"
                                                    value="{{Auth::user()->email}}" readonly="">
                                            </div>
                                            <button class="btn btn-block btn-big-primary" id="changeEmailLink">
                                                Change email
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="component_card">
                            <div class="card account-card">
															<form class="component_form_group" method="post" action="{{route('account.accountPost')}}">
																{{ csrf_field() }}
                                    <div class="">
                                        <div class="form-group">
                                            <label>Language</label>
                                            <div class="d-flex">
                                                <div class="w-100">
                                                    <select class="form-control" id="language" name="SettingsFrom[lang]">
                                                        <option value="en" selected="">English</option>
                                                    </select>
                                                </div>
                                                <div class="account-button-right">
                                                    <div class="component_button_save">
                                                        <input type="hidden" name="_csrf"
                                                            value="MLathwANWdYYUiKRaonSD4ZzSxb4_n1nXrTYc9KrZKlp0ZzgMlw-tC9iTfhSu-Y70T9mJ6GPSjBt7rlBvuJW8w==">
                                                        <button type="submit" class="btn btn-block btn-big-primary">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="component_card">
                            <div class="card account-card">
																@foreach ($errors->all() as $error)
																	<div class="alert alert-dismissible alert-danger ">
																		<button type="button" class="close" data-dismiss="alert">×</button>
																		{{ $error }}
																</div>
																@endforeach
                                <form class="component_form_group" method="post" action="">
																	{{ csrf_field() }}
                                    <div class="">
                                        <div class="form-group">
                                            <label>Current password</label>
                                            <input type="password" class="form-control" id="current"
                                                name="current_password">
                                        </div>
                                        <div class="form-group">
                                            <label>New password</label>
                                            <input type="password" class="form-control" id="new"
                                                name="new_password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm new password</label>
                                            <input type="password" class="form-control" id="confirm"
                                                name="confirm_password">
                                        </div>
                                    </div>
                                    <div class="component_button_save">
                                        <div class="">
                                            <button class="btn btn-block btn-big-primary" type="submit">
                                                Change password
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="component_card">
                            <div class="card account-card">
                                <form class="component_form_group" method="post" action="{{route('account.accountPost')}}">
																	{{ csrf_field() }}
                                    <div class="">
                                        <div class="form-group">
                                            <label>Timezone</label>
                                            <div class="d-flex">
                                                <div class="w-100">
                                                    <select name="time_zone" id="timezone"
                                                        class="form-control">
                                                        @foreach(config('common.timezone') as $key => $value)
                                                        <option value="{{$key}}" {{ (Auth::user()->time_zone && Auth::user()->time_zone == $key) ? 'selected' : ''}}>{{$value}}</option>
																												@endforeach
                                                    </select>
                                                </div>
                                                <div class="account-button-right">
                                                    <div class="component_button_save">
                                                        <div class="">
                                                            <button class="btn btn-block btn-big-primary" type="submit">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="component_card">
                            <div class="card account-card">
                                <form class="component_form_group" action="{{route('account.newkey')}}" method="post">
																	{{ csrf_field() }}
                                    <div class="">
                                        <div class="form-group">
                                            <label>API key</label>
                                            <div class="d-flex">
																							@if(Auth::user()->key_api)
                                                <div class="w-100">
                                                    <input type="text" class="form-control" id="api_key"
                                                        value="{{Auth::user()->key_api ? str_repeat('*', strlen(Auth::user()->key_api)) : ''}}" readonly=""
                                                        data-original-title="" title="">
                                                </div>
																								@endif
                                                <div class="account-button-right">
                                                    <div class="component_button_save">
                                                        <div class="">
                                                            <button class="btn btn-block btn-big-primary" type="submit">
                                                                Generate new
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(Auth::user()->key_api)<small class="help-block">Created: {{Auth::user()->updated_at}}</small>@endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
