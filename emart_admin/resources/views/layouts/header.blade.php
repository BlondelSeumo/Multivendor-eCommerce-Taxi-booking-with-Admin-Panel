<div class="navbar-header">
    <a class="navbar-brand" href="<?php echo URL::to('/'); ?>">
        <b>
            <img src="{{ asset('/images/logo_web.png') }}" alt="homepage" class="dark-logo" width="100%" id="logo_web">
            <img src="{{ asset('images/logo-light-icon.png') }}" alt="homepage" class="light-logo">
        </b>
        <span>
        </span>
    </a>
</div>

<div class="navbar-collapse">
	
    <ul class="navbar-nav mr-auto mt-md-0">
        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
    </ul>

    <div style="visibility: hidden;" class="language-list icon d-flex align-items-center text-light ml-2" id="language_dropdown_box">
        <div class="language-select">
            <i class="fa fa-globe"></i>
        </div>
        <div class="language-options">
            <select class="form-control changeLang text-dark" id="language_dropdown"></select>
        </div>
    </div>
    <ul class="navbar-nav my-lg-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('/images/users/user-new.png') }}" alt="user" class="profile-pic"></a>
            <div class="dropdown-menu dropdown-menu-right scale-up">
                <ul class="dropdown-user">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="{{ asset('/images/users/user-2.png') }}" alt="user" style="max-width: 45px;"></div>
                            <div class="u-text">
                                <h4>{{trans('lang.super_user')}}</h4>
                                <p class="text-muted">{{trans('lang.super_administrator')}}</p>
                             </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('users.profile') }}"><i class="ti-user"></i>  {!! trans('lang.user_profile') !!}</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    	@csrf
                    </form>
                </ul>
            </div>
        </li>
    </ul>
</div>