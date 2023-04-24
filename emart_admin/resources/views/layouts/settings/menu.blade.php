

<div class="card {{
             Request::is('settings/app/*') ||
             Request::is('settings/app/social*') ||
             Request::is('settings/payment/*') ||
             Request::is('settings/currencies*') ||
             Request::is('settings/app/adminCommission*') ||
             Request::is('settings/vendorNearBy*')
 ? '' : 'collapsed-card' }}">
    <div class="card-header">
        <h3 class="card-title">{{trans('lang.app_setting_globals')}}</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa {{
             Request::is('settings/app/*') ||
             Request::is('settings/payment*') ||
             Request::is('settings/currencies*') ||
             Request::is('settings/vendorNearBy*')
             ? 'fa-minus' : 'fa-plus' }}"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="{!! url('settings/app/globals') !!}" class="nav-link {{  Request::is('settings/app/globals*') ? 'selected' : '' }}">
                    <i class="fa fa-cog"></i> {{trans('lang.app_setting_globals')}}
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/app/social') !!}" class="nav-link {{  Request::is('settings/app/social*') ? 'selected' : '' }}">
                    <i class="fa fa-globe"></i> {{trans('lang.app_setting_social')}}
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/payment/payment') !!}" class="nav-link {{  Request::is('settings/payment*') ? 'selected' : '' }}">
                    <i class="fa fa-credit-card"></i> {{trans('lang.app_setting_payment')}}
                </a>
            </li>

            @can('currencies.index')
                <li class="nav-item">
                    <a href="{!! route('currencies.index') !!}" class="nav-link {{ Request::is('settings/currencies*') ? 'selected' : '' }}" ><i class="nav-icon fa fa-dollar ml-1"></i> {{trans('lang.currency_plural')}}</a>
                </li>
            @endcan

            <li class="nav-item">
                <a href="{!! url('settings/app/notifications') !!}" class="nav-link {{  Request::is('settings/app/notifications*') || Request::is('notificationTypes*') ? 'selected' : '' }}">
                    <i class="fa fa-bell"></i> {{trans('lang.app_setting_notifications')}}
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/app/adminCommission') !!}" class="nav-link {{  Request::is('settings/app/adminCommission*') || Request::is('adminCommission*') ? 'selected' : '' }}">
                    <i class="fa fa-percent"></i> Admin Commission
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/vendorNearBy') !!}" class="nav-link {{  Request::is('settings/vendorNearBy*') || Request::is('vendorNearBy*') ? 'selected' : '' }}">
                    <i class="fa fa-road"></i> GroMart Nearby Radios
                </a>
            </li>

        </ul>
    </div>
</div>


<div class="card {{ Request::is('settings/mobile*') ? '' : 'collapsed-card' }}">
    <div class="card-header">
        <h3 class="card-title">{{trans('lang.mobile_menu')}}</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa {{ Request::is('settings/mobile*') ? 'fa-minus' : 'fa-plus' }}"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="{!! url('settings/mobile/globals') !!}" class="nav-link {{  Request::is('settings/mobile/globals*') ? 'selected' : '' }}">
                    <i class="fa fa-inbox"></i> {{trans('lang.mobile_globals')}}
                </a>
            </li>

        </ul>
    </div>
</div>
