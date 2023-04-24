<nav id="main-nav">
    <ul class="second-nav">
        <li><a href="{{url('/')}}"><i class="feather-home mr-2"></i> {{trans('lang.home_page')}}</a></li>
        @auth
            <?php if(@$_COOKIE['service_type'] == "Parcel Delivery Service"){ ?>
            <li><a href="{{url('parcel_orders')}}"><i class="feather-list mr-2"></i> {{trans('lang.my_orders')}}</a>
            </li>
            <?php }else if(@$_COOKIE['service_type'] == "Rental Service"){ ?>
            <li><a href="{{url('rental_orders')}}"><i class="feather-list mr-2"></i> {{trans('lang.my_orders')}}</a>
            </li>
            <?php }else{ ?>
            <li><a href="{{url('my_order')}}"><i class="feather-list mr-2"></i> {{trans('lang.my_orders')}}</a></li>
            <?php } ?>
            <li><a href="{{url('transactions')}}"><i class="feather-list mr-2"></i> {{trans('lang.my_transactions')}}
                </a></li>
            <?php if(@$_COOKIE['service_type'] != "Rental Service" && @$_COOKIE['service_type'] != "Parcel Delivery Service" && @$_COOKIE['service_type'] != "Cab Service" ){ ?>
            <li><a href="{{url('favorite-stores')}}"><i
                            class="feather-heart mr-2"></i> {{trans('lang.favorite_stores')}}</a></li>
            <li><a href="{{url('favorite-products')}}"><i
                            class="feather-heart mr-2"></i> {{trans('lang.favorite_products')}}</a></li>
            <li><a href="{{url('vendors')}}"><i class="feather-list mr-2"></i> {{trans('lang.all_store')}}</a></li>
            <?php } ?>
            <li class="dine_in_menu hide_tab" style="display:none;"><a href="{{url('vendors')}}?dinein=1"><i
                            class="feather-list mr-2"></i>{{trans('lang.dine_in_vendor')}}</a></li>
            <li style="display:none;" class="dine_in_menu dineinrestaurant_tab hide_tab"><a href="{{url('my_dinein')}}"><i
                            class="feather-list mr-2"></i>{{trans('lang.my_dine_in_requests')}}</a></li>
            <li><a href="{{url('profile')}}"><i class="feather-user mr-2"></i>{{trans('lang.user_profile')}}</a></li>
            <li><a href="{{url('contact-us')}}"><i class="feather-user mr-2"></i>{{trans('lang.contact_us')}}</a></li>
            <li><a href="{{url('logout')}}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="feather-user mr-2"></i>{{trans('lang.logout')}}</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <li><a href="{{url('contact-us')}}"><i class="feather-user mr-2"></i>{{trans('lang.contact_us')}}</a></li>
            <?php if(@$_COOKIE['service_type'] != "Rental Service" && @$_COOKIE['service_type'] != "Parcel Delivery Service" && @$_COOKIE['service_type'] != "Cab Service" ){ ?>
            <li><a href="{{url('vendors')}}"><i class="feather-list mr-2"></i> {{trans('lang.all_store')}}</a></li>
            <?php } ?>
            <li class="dine_in_menu hide_tab" style="display:none;"><a href="{{url('vendors')}}?dinein=1"><i
                            class="feather-list mr-2"></i>{{trans('lang.dine_in_vendor')}}</a></li>
            <li><a href="{{url('login')}}"><i class="feather-user mr-2"></i>{{trans('lang.login')}}</a></li>
            <li><a href="{{url('signup')}}"><i class="feather-user mr-2"></i>{{trans('lang.register')}}</a></li>
        @endauth

        <li><p class="web_version"></p></li>
    </ul>


    <ul class="bottom-nav">
        <li class="email">
            <a class="text-danger" href="{{url('/')}}">
                <p class="h5 m-0"><i class="feather-home text-danger"></i></p>
                {{trans('lang.home')}}
            </a>
        </li>
        <li class="ko-fi">
            <a href="{{url('contact-us')}}">
                <p class="h5 m-0"><i class="feather-phone"></i></p>
                {{trans('lang.help')}}
            </a>
        </li>
    </ul>
</nav>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('lang.filter')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="siddhi-filter">
                    <div class="filter">
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">{{trans('lang.SORT_BY')}} </h6>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio1f" name="location" class="custom-control-input" checked>
                            <label class="custom-control-label py-3 w-100 px-3"
                                   for="customRadio1f">{{trans('lang.top_rated')}}</label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio2f" name="location" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3"
                                   for="customRadio2f">{{trans('lang.nearest_me')}} </label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio3f" name="location" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3"
                                   for="customRadio3f"> {{trans('lang.cost_high_to_low')}} </label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio4f" name="location" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3"
                                   for="customRadio4f">{{trans('lang.cost_low_to_high')}} </label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-radio">
                            <input type="radio" id="customRadio5f" name="location" class="custom-control-input">
                            <label class="custom-control-label py-3 w-100 px-3"
                                   for="customRadio5f"> {{trans('lang.most_popular')}} </label>
                        </div>
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">{{trans('lang.FILTER')}} </h6>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultCheck1" checked>
                            <label class="custom-control-label py-3 w-100 px-3"
                                   for="defaultCheck1">{{trans('lang.open_now')}} </label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultCheck2">
                            <label class="custom-control-label py-3 w-100 px-3"
                                   for="defaultCheck2">{{trans('lang.credit_cards')}} </label>
                        </div>
                        <div class="custom-control border-bottom px-0  custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="defaultCheck3">
                            <label class="custom-control-label py-3 w-100 px-3"
                                   for="defaultCheck3">{{trans('lang.alcohol_served')}} </label>
                        </div>
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="m-0">{{trans('lang.ADDITIONAL_FILTERS')}} </h6>
                        </div>
                        <div class="px-3 pt-3">
                            <input type="range" class="custom-range" min="0" max="100" name="minmax">
                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label>{{trans('lang.min')}} </label>
                                    <input class="form-control" placeholder="$0" type="number">
                                </div>
                                <div class="form-group text-right col-6">
                                    <label>{{trans('lang.max')}} </label>
                                    <input class="form-control" placeholder="$1,0000" type="number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-0 border-0">
                <div class="col-6 m-0 p-0">
                    <button type="button" class="btn border-top btn-lg btn-block"
                            data-dismiss="modal">{{trans('lang.close')}}</button>
                </div>
                <div class="col-6 m-0 p-0">
                    <button type="button" class="btn btn-primary btn-lg btn-block">{{trans('lang.apply')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var database = firebase.firestore();

    var version = database.collection('settings').doc("Version");

    version.get().then(async function (snapshots) {
        var version_data = snapshots.data();

        if (version_data == undefined) {
            database.collection('settings').doc('Version').set({});
        }
        try {

            $('.web_version').html("V:" + version_data.web_version);

        } catch (error) {

        }

    });
</script>