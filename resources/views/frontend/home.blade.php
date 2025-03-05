@extends('frontend.layouts.app')
@section('scriptFooter')
        <script>typeof _api !== 'undefined' && _api.init();</script>
@endsection
@section('content')
<div id="block_18">
    <div class="block-signin-text ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="block-signin-text__block-text">
                        <div class="block-signin-text__block-text-title">
                            <h1><span style="color: rgba(240, 147, 0, 1)">{{request()->getHost()}}</span></h1>
                            <h1>#1 SMM Panel In The <span
                                    style="color: rgba(103, 217, 24, 1)">World</span> <span
                                    style="color: rgba(103, 217, 24, 1)">!</span></h1>
                            <h1>Cheapest and most trustful social media marketing service <span
                                    style="color: #000000">supplier</span>.</h1>
                        </div>
                        <div class="block-signin-text__block-text-description">
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="line-height: 20px"><span
                                        style="color: #000">✔ Buy Youtube -
                                        Views/Subcribers/Likes/Suggested/Targeted/Share</span></span>
                            </p>
                            <p><span style="line-height: 20px"><span
                                        style="color: #000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;✔
                                        Buy Facebook - Likes/Views/Photo/Video/Share</span></span></p>
                            <p><span style="line-height: 20px"><span
                                        style="color: #000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;✔
                                        Buy Instagram - Followers/Likes/Views/Comments</span></span></p>
                            <p><span style="line-height: 20px"><span
                                        style="color: #000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;✔
                                        Buy Tiktok - Followers/Likes/Views/Comments</span></span></p>
                            <p><span style="line-height: 20px"><span
                                        style="color: #000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;✔
                                        Buy Twitter - Followers/Retweets/Favorites</span></span></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="component_card">
                        <div class="card">
                            <form class="form-horizontal" method="POST" action="{{ route('loginCustomerAction') }}">
                                {{ csrf_field() }}
                                <div>
                                    @if(session('status'))
                                    <div class="error" role="alert">
                                        {{session('status')}}
                                    </div>
                                    @endif
                                    <div class="component_form_group">
                                        <div class="">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text"  id="name" name="name" value="{{ old('name') }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        @if($errors->has('name'))
                                        <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="component_form_group">
                                        <div class="">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <div class="position-relative">
                                                    <input type="password" value="{{ old('password') }}" name="password" type="password" 
                                                        class="form-control">
                                                    <div
                                                        class="sign-in__forgot h-100 d-flex align-items-center">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="component_button_submit">
                                            <div class="">
                                                <button class="btn btn-block btn-big-primary"
                                                    type="submit">
                                                    Sign in
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center d-flex justify-content-center">
                                    <div>Do not have an account?</div>
                                    <a href="{{route('home.signup')}}" class="block-signin-text__sign-up-link">Sign
                                        up</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="block_19">
    <div class="features-block-icons ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row align-items-start justify-content-start">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card features-block__card h-100"
                        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ">
                        <div class="features-block__header">
                            <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                style="margin-bottom: 10px;
                         height: 96px;                                                                                                                                                                                                                                                 ">
                                <span class="feature-block__icon fal fa-trophy-alt"
                                    style="
                            font-size: 55px;
                            transform: rotate(0deg);
                            color: ;
                            text-shadow: none;
                            border-radius: 0px;
                            background: transparent;
                            padding: 10px;
                            "></span>
                            </div>
                            <div class="features-block__header-title"
                                style="margin-bottom: 8px; padding-left: 0px; padding-right: 0px;">
                                <p><strong style="font-weight: bold">Superb quality</strong></p>
                            </div>
                        </div>
                        <div class="features-block__body">
                            <div class="features-block__body-description"
                                style="padding-left: 0px; padding-right: 0px;">
                                <p>You'll be satisfied with SMM services we provide.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card features-block__card h-100"
                        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ">
                        <div class="features-block__header">
                            <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                style="margin-bottom: 10px;
                         height: 96px;                                                                                                                                                                                                                                                 ">
                                <span class="feature-block__icon fal fa-box-usd"
                                    style="
                            font-size: 55px;
                            transform: rotate(0deg);
                            color: ;
                            text-shadow: none;
                            border-radius: 0px;
                            background: transparent;
                            padding: 10px;
                            "></span>
                            </div>
                            <div class="features-block__header-title"
                                style="margin-bottom: 8px; padding-left: 0px; padding-right: 0px;">
                                <p><strong style="font-weight: bold">Diverse payment methods</strong>
                                </p>
                            </div>
                        </div>
                        <div class="features-block__body">
                            <div class="features-block__body-description"
                                style="padding-left: 0px; padding-right: 0px;">
                                <p>Pick from a fantastic selection of payment options we provide.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card features-block__card h-100"
                        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ">
                        <div class="features-block__header">
                            <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                style="margin-bottom: 10px;
                         height: 96px;                                                                                                                                                                                                                                                 ">
                                <span class="feature-block__icon fal fa-usd-circle"
                                    style="
                            font-size: 55px;
                            transform: rotate(0deg);
                            color: ;
                            text-shadow: none;
                            border-radius: 0px;
                            background: transparent;
                            padding: 10px;
                            "></span>
                            </div>
                            <div class="features-block__header-title"
                                style="margin-bottom: 8px; padding-left: 0px; padding-right: 0px;">
                                <p><strong style="font-weight: bold">Lowest prices</strong></p>
                            </div>
                        </div>
                        <div class="features-block__body">
                            <div class="features-block__body-description"
                                style="padding-left: 0px; padding-right: 0px;">
                                <p>Here you can purchase SMM services at super affordable prices!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card features-block__card h-100"
                        style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 ">
                        <div class="features-block__header">
                            <div class="features-block__header-preview style-bg-primary-alpha-10 style-border-radius-default style-text-primary"
                                style="margin-bottom: 10px;
                         height: 96px;                                                                                                                                                                                                                                                 ">
                                <span class="feature-block__icon fal fa-rocket-launch"
                                    style="
                            font-size: 55px;
                            transform: rotate(0deg);
                            color: ;
                            text-shadow: none;
                            border-radius: 0px;
                            background: transparent;
                            padding: 10px;
                            "></span>
                            </div>
                            <div class="features-block__header-title"
                                style="margin-bottom: 8px; padding-left: 0px; padding-right: 0px;">
                                <p><strong style="font-weight: bold">Very quick delivery</strong></p>
                            </div>
                        </div>
                        <div class="features-block__body">
                            <div class="features-block__body-description"
                                style="padding-left: 0px; padding-right: 0px;">
                                <p>You will be surprised at how quick our order delivery is.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="block_21">
    <div class="how-it-works ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row how-it-works-row justify-content-start">
                <div class="col-md-3 how-it-works-col">
                    <div class="how-it-works-card">
                        <div class="how-it-works-arrow-top style-svg-g-primary">
                            <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g transform="translate(-942.000000, -1387.000000)" fill="#1E79E4"
                                        id="Group-10">
                                        <g transform="translate(165.000000, 1368.000000)">
                                            <path
                                                d="M889.516523,26.5080119 L891.910644,20.9496585 L902,32.9164837 L886.372927,33.807873 L888.723185,28.3469617 C871.347087,21.9210849 854.507984,19.7125409 838.195168,21.7129851 C818.169006,24.1687976 798.907256,32.9719131 780.398868,48.1424468 L779.638673,48.7694781 L778.869195,49.4081513 L777.591849,47.8691952 L778.361327,47.2305219 C797.38492,31.4407805 817.252224,22.2662407 837.951732,19.7278557 C854.622929,17.6834632 871.814783,19.9463129 889.516523,26.5080119 Z"
                                                id="Line3"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="how-it-works-arrow-bottom style-svg-g-primary">
                            <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g transform="translate(-657.000000, -1461.000000)" fill="#1E79E4"
                                        id="Group-10">
                                        <g transform="translate(165.000000, 1368.000000)">
                                            <path
                                                d="M493.869195,93.5918487 L494.638673,94.2305219 C513.37968,109.785715 532.894675,118.797561 553.195168,121.287015 C569.507984,123.287459 586.347087,121.078915 603.723185,114.653038 L601.372927,109.192127 L617,110.083516 L606.910644,122.050341 L604.516523,116.491988 C586.814783,123.053687 569.622929,125.316537 552.951732,123.272144 C532.528218,120.767604 512.914862,111.802694 494.12272,96.3975396 L493.361327,95.7694781 L492.591849,95.1308048 L493.869195,93.5918487 Z"
                                                id="Line2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="d-flex justify-content-center how-it-works-preview"
                            style="margin-bottom: 12px;">
                            <div class="how-it-works-number style-box-shadow-default style-bg-color-light style-border-radius-50"
                                style="
                     font-size: 32px;                                      width: 95px;                                      height: 95px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ">
                                1
                            </div>
                        </div>
                        <div class="how-it-works-title"
                            style="margin-bottom: 8px; padding-left: 0px; padding-right: 0x;">
                            <p class="text-center"><span style="text-align: CENTER"><strong
                                        style="font-weight: bold">1. Register</strong></span></p>
                        </div>
                        <div class="how-it-works-description"
                            style="padding-left: 0px; padding-right: 0x;">
                            <p class="text-center"><span style="text-align: CENTER">Create your panel
                                    account first and then log in.</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 how-it-works-col">
                    <div class="how-it-works-card">
                        <div class="how-it-works-arrow-top style-svg-g-primary">
                            <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g transform="translate(-942.000000, -1387.000000)" fill="#1E79E4"
                                        id="Group-10">
                                        <g transform="translate(165.000000, 1368.000000)">
                                            <path
                                                d="M889.516523,26.5080119 L891.910644,20.9496585 L902,32.9164837 L886.372927,33.807873 L888.723185,28.3469617 C871.347087,21.9210849 854.507984,19.7125409 838.195168,21.7129851 C818.169006,24.1687976 798.907256,32.9719131 780.398868,48.1424468 L779.638673,48.7694781 L778.869195,49.4081513 L777.591849,47.8691952 L778.361327,47.2305219 C797.38492,31.4407805 817.252224,22.2662407 837.951732,19.7278557 C854.622929,17.6834632 871.814783,19.9463129 889.516523,26.5080119 Z"
                                                id="Line3"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="how-it-works-arrow-bottom style-svg-g-primary">
                            <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g transform="translate(-657.000000, -1461.000000)" fill="#1E79E4"
                                        id="Group-10">
                                        <g transform="translate(165.000000, 1368.000000)">
                                            <path
                                                d="M493.869195,93.5918487 L494.638673,94.2305219 C513.37968,109.785715 532.894675,118.797561 553.195168,121.287015 C569.507984,123.287459 586.347087,121.078915 603.723185,114.653038 L601.372927,109.192127 L617,110.083516 L606.910644,122.050341 L604.516523,116.491988 C586.814783,123.053687 569.622929,125.316537 552.951732,123.272144 C532.528218,120.767604 512.914862,111.802694 494.12272,96.3975396 L493.361327,95.7694781 L492.591849,95.1308048 L493.869195,93.5918487 Z"
                                                id="Line2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="d-flex justify-content-center how-it-works-preview"
                            style="margin-bottom: 12px;">
                            <div class="how-it-works-number style-box-shadow-default style-bg-color-light style-border-radius-50"
                                style="
                     font-size: 32px;                                      width: 95px;                                      height: 95px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ">
                                2
                            </div>
                        </div>
                        <div class="how-it-works-title"
                            style="margin-bottom: 8px; padding-left: 0px; padding-right: 0x;">
                            <p class="text-center"><span style="text-align: CENTER"><strong
                                        style="font-weight: bold">2. Deposit funds</strong></span></p>
                        </div>
                        <div class="how-it-works-description"
                            style="padding-left: 0px; padding-right: 0x;">
                            <p class="text-center"><span style="text-align: CENTER">Add funds to your
                                    account via a preferred payment option.</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 how-it-works-col">
                    <div class="how-it-works-card">
                        <div class="how-it-works-arrow-top style-svg-g-primary">
                            <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g transform="translate(-942.000000, -1387.000000)" fill="#1E79E4"
                                        id="Group-10">
                                        <g transform="translate(165.000000, 1368.000000)">
                                            <path
                                                d="M889.516523,26.5080119 L891.910644,20.9496585 L902,32.9164837 L886.372927,33.807873 L888.723185,28.3469617 C871.347087,21.9210849 854.507984,19.7125409 838.195168,21.7129851 C818.169006,24.1687976 798.907256,32.9719131 780.398868,48.1424468 L779.638673,48.7694781 L778.869195,49.4081513 L777.591849,47.8691952 L778.361327,47.2305219 C797.38492,31.4407805 817.252224,22.2662407 837.951732,19.7278557 C854.622929,17.6834632 871.814783,19.9463129 889.516523,26.5080119 Z"
                                                id="Line3"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="how-it-works-arrow-bottom style-svg-g-primary">
                            <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g transform="translate(-657.000000, -1461.000000)" fill="#1E79E4"
                                        id="Group-10">
                                        <g transform="translate(165.000000, 1368.000000)">
                                            <path
                                                d="M493.869195,93.5918487 L494.638673,94.2305219 C513.37968,109.785715 532.894675,118.797561 553.195168,121.287015 C569.507984,123.287459 586.347087,121.078915 603.723185,114.653038 L601.372927,109.192127 L617,110.083516 L606.910644,122.050341 L604.516523,116.491988 C586.814783,123.053687 569.622929,125.316537 552.951732,123.272144 C532.528218,120.767604 512.914862,111.802694 494.12272,96.3975396 L493.361327,95.7694781 L492.591849,95.1308048 L493.869195,93.5918487 Z"
                                                id="Line2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="d-flex justify-content-center how-it-works-preview"
                            style="margin-bottom: 12px;">
                            <div class="how-it-works-number style-box-shadow-default style-bg-color-light style-border-radius-50"
                                style="
                     font-size: 32px;                                      width: 95px;                                      height: 95px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ">
                                3
                            </div>
                        </div>
                        <div class="how-it-works-title"
                            style="margin-bottom: 8px; padding-left: 0px; padding-right: 0x;">
                            <p class="text-center"><span style="text-align: CENTER"><strong
                                        style="font-weight: bold">3. Select services</strong></span>
                            </p>
                        </div>
                        <div class="how-it-works-description"
                            style="padding-left: 0px; padding-right: 0x;">
                            <p class="text-center"><span style="text-align: CENTER">Place orders and
                                    get ready to see your business gain more popularity.</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 how-it-works-col">
                    <div class="how-it-works-card">
                        <div class="how-it-works-arrow-top style-svg-g-primary">
                            <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g transform="translate(-942.000000, -1387.000000)" fill="#1E79E4"
                                        id="Group-10">
                                        <g transform="translate(165.000000, 1368.000000)">
                                            <path
                                                d="M889.516523,26.5080119 L891.910644,20.9496585 L902,32.9164837 L886.372927,33.807873 L888.723185,28.3469617 C871.347087,21.9210849 854.507984,19.7125409 838.195168,21.7129851 C818.169006,24.1687976 798.907256,32.9719131 780.398868,48.1424468 L779.638673,48.7694781 L778.869195,49.4081513 L777.591849,47.8691952 L778.361327,47.2305219 C797.38492,31.4407805 817.252224,22.2662407 837.951732,19.7278557 C854.622929,17.6834632 871.814783,19.9463129 889.516523,26.5080119 Z"
                                                id="Line3"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="how-it-works-arrow-bottom style-svg-g-primary">
                            <svg width="125px" height="31px" viewBox="0 0 125 31" version="1.1"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Landing" stroke="none" stroke-width="1" fill="none"
                                    fill-rule="evenodd">
                                    <g transform="translate(-657.000000, -1461.000000)" fill="#1E79E4"
                                        id="Group-10">
                                        <g transform="translate(165.000000, 1368.000000)">
                                            <path
                                                d="M493.869195,93.5918487 L494.638673,94.2305219 C513.37968,109.785715 532.894675,118.797561 553.195168,121.287015 C569.507984,123.287459 586.347087,121.078915 603.723185,114.653038 L601.372927,109.192127 L617,110.083516 L606.910644,122.050341 L604.516523,116.491988 C586.814783,123.053687 569.622929,125.316537 552.951732,123.272144 C532.528218,120.767604 512.914862,111.802694 494.12272,96.3975396 L493.361327,95.7694781 L492.591849,95.1308048 L493.869195,93.5918487 Z"
                                                id="Line2"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="d-flex justify-content-center how-it-works-preview"
                            style="margin-bottom: 12px;">
                            <div class="how-it-works-number style-box-shadow-default style-bg-color-light style-border-radius-50"
                                style="
                     font-size: 32px;                                      width: 95px;                                      height: 95px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     ">
                                4
                            </div>
                        </div>
                        <div class="how-it-works-title"
                            style="margin-bottom: 8px; padding-left: 0px; padding-right: 0x;">
                            <p class="text-center"><span style="text-align: CENTER"><strong
                                        style="font-weight: bold">4. Fast results</strong></span></p>
                        </div>
                        <div class="how-it-works-description"
                            style="padding-left: 0px; padding-right: 0x;">
                            <p class="text-center"><span style="text-align: CENTER">You will be
                                    satisfied with our services once your order is complete.</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="block_109">
    <div class="header-with-text ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-block__title">
                        <h2 class="text-center"><span style="color: #ffffff"><span
                                    style="text-align: CENTER">Boost yout brand
                                    reputation</span></span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="text-block__description">
                        <p class="text-center"><span style="color: #ffffff">We are help dominate
                                social media with the largest social media panel.</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="block_107">
    <div class="reviews-slider ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="reviews-slider">
                        <div data-slider="1"
                            data-slider-options="{'dots':true,'infinite':true,'speed':500,'autoplay':true,'autoplaySpeed':5000,'slidesToShow':2,'slidesToScroll':1,'responsive':[{'breakpoint':991,'settings':{'slidesToShow':1,'slidesToScroll':1}}],'rtl':false}">
                            <div class="reviews-slider__slide">
                                <div class="card"
                                    style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ">
                                    <div class="reviews-slider__slide-photo"
                                        style="margin-bottom: 16px; justify-content: flex-start;">
                                        <div class="reviews-slider__slide-avatar"
                                            style="background-image: url(img/no_image.png);"></div>
                                    </div>
                                    <div class="reviews-slider__slide-name"
                                        style="padding-left: 0px; padding-right: 0px; margin-bottom: 10px;">
                                        <p><strong style="font-weight: bold">Juliana Diaz</strong></p>
                                    </div>
                                    <div class="reviews-slider__slide-description"
                                        style="padding-left: 0px; padding-right: 0px;">
                                        <p>I do SMM promotions for different businesses and this panel
                                            has been such a great discovery for me! I used to spend lots
                                            of time doing some tasks that can be done super quickly now
                                            because SMM services here are delivered so fast. Thank you
                                            guys!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="reviews-slider__slide">
                                <div class="card"
                                    style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ">
                                    <div class="reviews-slider__slide-photo"
                                        style="margin-bottom: 16px; justify-content: flex-start;">
                                        <div class="reviews-slider__slide-avatar"
                                            style="background-image: url(img/no_image.png);"></div>
                                    </div>
                                    <div class="reviews-slider__slide-name"
                                        style="padding-left: 0px; padding-right: 0px; margin-bottom: 8px;">
                                        <p><strong style="font-weight: bold">Sophia Harris</strong></p>
                                    </div>
                                    <div class="reviews-slider__slide-description"
                                        style="padding-left: 0px; padding-right: 0px;">
                                        <p>If you're wondering how you can help your social media
                                            accounts get more attention fast, this is it! No need to
                                            wait for a long time either because SMM services on this
                                            panel are delivered super quickly. The services are sooo
                                            cheap too.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="reviews-slider__slide">
                                <div class="card"
                                    style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ">
                                    <div class="reviews-slider__slide-photo"
                                        style="margin-bottom: 10px; justify-content: flex-start;">
                                        <div class="reviews-slider__slide-avatar"
                                            style="background-image: url(img/no_image.png);"></div>
                                    </div>
                                    <div class="reviews-slider__slide-name"
                                        style="padding-left: 0px; padding-right: 0px; margin-bottom: 8px;">
                                        <p><strong style="font-weight: bold">Bayram Koc</strong></p>
                                    </div>
                                    <div class="reviews-slider__slide-description"
                                        style="padding-left: 0px; padding-right: 0px;">
                                        <p>I help different businesses to get more exposure online by
                                            managing their social media accounts. Let me tell you this:
                                            SMM services that this panel offers help me save so much
                                            extra money and earn way more than I did before I discovered
                                            these guys. Couldn't recommend them enough.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="block_110">
    <div class="faq ">
        <div class="bg"></div>
        <div class="divider-top"></div>
        <div class="divider-bottom"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="faq-block__card">
                                <div class="card"
                                    style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                    <div class="faq-block__header collapsed" data-toggle="collapse"
                                        data-target="#faq-block-110-1" aria-expanded="false"
                                        aria-controls="#faq-block-110-1">
                                        <div class="faq-block__header-title">
                                            <h4>What is an SMM panel?</h4>
                                        </div>
                                        <div class="faq-block__header-icon">
                                            <div class="style-text-dark faq-block__icon"
                                                style=""></div>
                                        </div>
                                    </div>
                                    <div class="faq-block__body collapse" id="faq-block-110-1">
                                        <div class="faq-block__body-description"
                                            style="padding-top: 8px">
                                            <p>SMM panels are online stores where people are able to
                                                purchase cheap SMM services.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="faq-block__card">
                                <div class="card"
                                    style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                    <div class="faq-block__header collapsed" data-toggle="collapse"
                                        data-target="#faq-block-110-2" aria-expanded="false"
                                        aria-controls="#faq-block-110-2">
                                        <div class="faq-block__header-title">
                                            <h4>What SMM services can I buy on your panel?</h4>
                                        </div>
                                        <div class="faq-block__header-icon">
                                            <div class="style-text-dark faq-block__icon"
                                                style=""></div>
                                        </div>
                                    </div>
                                    <div class="faq-block__body collapse" id="faq-block-110-2">
                                        <div class="faq-block__body-description"
                                            style="padding-top: 8px">
                                            <p>Our panel provides different types of SMM services, such
                                                as followers, views, likes and more.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="faq-block__card">
                                <div class="card"
                                    style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                    <div class="faq-block__header collapsed" data-toggle="collapse"
                                        data-target="#faq-block-110-3" aria-expanded="false"
                                        aria-controls="#faq-block-110-3">
                                        <div class="faq-block__header-title">
                                            <h4>Are SMM services offered here safe to order?</h4>
                                        </div>
                                        <div class="faq-block__header-icon">
                                            <div class="style-text-dark faq-block__icon"
                                                style=""></div>
                                        </div>
                                    </div>
                                    <div class="faq-block__body collapse" id="faq-block-110-3">
                                        <div class="faq-block__body-description"
                                            style="padding-top: 8px">
                                            <p>Using our SMM services is 100% safe, our panel is secure
                                                and we offer high-quality services.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="faq-block__card">
                                <div class="card"
                                    style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                    <div class="faq-block__header collapsed" data-toggle="collapse"
                                        data-target="#faq-block-110-4" aria-expanded="false"
                                        aria-controls="#faq-block-110-4">
                                        <div class="faq-block__header-title">
                                            <h4>A mass order — what is it?</h4>
                                        </div>
                                        <div class="faq-block__header-icon">
                                            <div class="style-text-dark faq-block__icon"
                                                style=""></div>
                                        </div>
                                    </div>
                                    <div class="faq-block__body collapse" id="faq-block-110-4">
                                        <div class="faq-block__body-description"
                                            style="padding-top: 8px">
                                            <p>A mass order allows placing multiple orders at once.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="faq-block__card">
                                <div class="card"
                                    style="
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ">
                                    <div class="faq-block__header collapsed" data-toggle="collapse"
                                        data-target="#faq-block-110-5" aria-expanded="false"
                                        aria-controls="#faq-block-110-5">
                                        <div class="faq-block__header-title">
                                            <h4>What is the purpose of Drip-feed?</h4>
                                        </div>
                                        <div class="faq-block__header-icon">
                                            <div class="style-text-dark faq-block__icon"
                                                style=""></div>
                                        </div>
                                    </div>
                                    <div class="faq-block__body collapse" id="faq-block-110-5">
                                        <div class="faq-block__body-description"
                                            style="padding-top: 8px">
                                            <p>The engagement on the chosen account can be built
                                                gradually, and Drip-feed will help you with that. For
                                                example, if you want 2000 likes on your Instagram post,
                                                you can divide them into parts for a seamless effect: as
                                                an option, you can get 200 likes/day for 10 days.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection