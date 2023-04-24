<meta name="csrf-token" content="{{ csrf_token() }}"/>

<header class="section-header">
    <?php
    if (Session::get('takeawayOption') == 'true' || Session::get('takeawayOption') == true) {
        $takeaway_options = true;
    } else {
        $takeaway_options = false;
    }
    ?>
    <script>
		<?php if($takeaway_options){ ?>
        	var takeaway_options = true;
		<?php }else{ ?>
        	var takeaway_options = false;
        <?php } ?>
        
        function takeAwayOnOff(takeAway) {
            var check_val;
            if (takeaway_options == true) {
                if (takeAway.checked == false) {

                    let isExecuted = confirm("If you select take away option then it will empty cart. are you sure want to do ?");
                    if (isExecuted) {
                    } else {
                        return false;
                    }
                }
            }
            if (takeAway.checked == true) {
                check_val = true;
                takeaway_options = true;
            } else {
                check_val = false;
                takeaway_options = false;
            }

            $.ajax({
                data: {
                    takeawayOption: check_val,
                    "_token": "{{ csrf_token() }}",
                },
                url: 'takeaway',
                type: 'POST',
                success: function (result) {
                    result = $.parseJSON(result);
                    location.reload();
                }
            });
        }
    </script>
    <section class="header-main shadow-sm bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-2">
                    <a href="{{url('/')}}" class="brand-wrap mb-0">
                        <img alt="#" class="img-fluid" src="{{asset('img/logo_web.png')}}" id="logo_web">
                    </a>
                </div>
                <div class="col-3 d-flex align-items-center m-none head-search">
                    <div class="dropdown mr-3">
                        <a class="text-dark dropdown-toggle d-flex align-items-center py-3" href="#" id="navbarDropdown"
                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="head-loc" onclick="getCurrentLocation('reload')"><i
                                        class="feather-map-pin mr-2 bg-light rounded-pill p-2 icofont-size"></i></div>
                            <div>
                                <input id="user_locationnew" type="text" size="50" class="pac-target-input">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-7 header-right">
                    <div class="d-flex align-items-center justify-content-end pr-5">
                        <?php if (@$_COOKIE['section_name'] != 'Parcel Service' && @$_COOKIE['section_name'] != 'Cab Service' && @$_COOKIE['section_name'] != 'Rental Service'){?>
                        <a href="{{url('search')}}" class="widget-header mr-4 text-dark">
                            <div class="icon d-flex align-items-center">
                                <i class="feather-search h6 mr-2 mb-0"></i> <span>{{trans('lang.search')}}</span>
                            </div>
                        </a>
                        <?php } ?>
                        <a href="{{url('offers')}}" class="widget-header mr-4 text-dark offer-link">
                            <div class="icon d-flex align-items-center">
                                <img alt="#" class="img-fluid mr-2" src="{{asset('img/discount.png')}}">
                                <span>{{trans('lang.offers')}}</span>
                            </div>
                        </a>
                        @auth

                        @else
                            <a href="{{url('login')}}" class="widget-header mr-4 text-dark m-none">
                                <div class="icon d-flex align-items-center">
                                    <i class="feather-user h6 mr-2 mb-0"></i> <span>{{trans('lang.sign_in')}}</span>
                                </div>
                            </a>
                        @endauth

                        <div class="dropdown mr-4 m-none">
                            <a href="#" class="dropdown-toggle text-dark py-3 d-block" id="dropdownMenuButton"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                @auth

                                    <a class="dropdown-item" href="{{url('profile')}}">{{trans('lang.my_account')}}</a>
                                    <?php if (@$_COOKIE['section_name'] != 'Parcel Service' && @$_COOKIE['section_name'] != 'Cab Service' && @$_COOKIE['section_name'] != 'Rental Service'){?>
                                    <a class="dropdown-item" href="{{url('vendors')}}">{{trans('lang.all_store')}}</a>
                                    <?php } ?>
                                    <a class="dropdown-item dine_in_menu" style="display: none;"
                                       href="{{url('vendors')}}?dinein=1">{{trans('lang.dine_in_vendor')}}</a>
                                    <a class="dropdown-item"
                                       href="{{ route('faq') }}">{{trans('lang.delivery_support')}}</a>
                                    <a class="dropdown-item"
                                       href="{{route('contact_us')}}">{{trans('lang.contact_us')}}</a>
                                    <a class="dropdown-item" href="{{ route('terms') }}">{{trans('lang.terms_use')}}</a>
                                    <a class="dropdown-item"
                                       href="{{ route('privacy') }}">{{trans('lang.privacy_policy')}}</a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">{{trans('lang.logout')}}</a>

                                @else
                                <?php if (@$_COOKIE['section_name'] != 'Parcel Service' && @$_COOKIE['section_name'] != 'Cab Service' && @$_COOKIE['section_name'] != 'Rental Service'){?>

                                    <a class="dropdown-item" href="{{url('vendors')}}">{{trans('lang.all_store')}}</a>
                                    <?php } ?>
                                    <a class="dropdown-item dine_in_menu" style="display: none;"
                                       href="{{url('vendors')}}?dinein=1">{{trans('lang.dine_in_vendor')}}</a>
                                    <a class="dropdown-item"
                                       href="{{ route('faq') }}">{{trans('lang.delivery_support')}}</a>
                                    <a class="dropdown-item"
                                       href="{{route('contact_us')}}">{{trans('lang.contact_us')}}</a>
                                    <a class="dropdown-item" href="{{ route('terms') }}">{{trans('lang.terms_use')}}</a>
                                    <a class="dropdown-item"
                                       href="{{ route('privacy') }}">{{trans('lang.privacy_policy')}}</a>

                                @endauth


                            </div>
                        </div>
                        <?php if (@$_COOKIE['section_name'] != 'Parcel Service' && @$_COOKIE['section_name'] != 'Cab Service' && @$_COOKIE['section_name'] != 'Rental Service'){?>

                        <a href="{{url('/checkout')}}" class="widget-header mr-4 text-dark">
                            <div class="icon d-flex align-items-center">
                                <i class="feather-shopping-cart h6 mr-2 mb-0"></i> <span>{{trans('lang.cart')}}</span>

                            </div>
                        </a>
                        <?php } ?>

                        <?php if (@$_COOKIE['service_type'] == 'Multivendor Delivery Service'){

                        if (Session::get('takeawayOption') == "true") { ?>
                        <div class="icon d-flex align-items-center text-dark takeaway-div">
											<span class="takeaway-btn">
												<i class="fa fa-car h6 mr-1 mb-0"></i> <span> {{trans('lang.take_away')}} </span>
												<input type="checkbox" onclick="takeAwayOnOff(this)"
                                                       <?php if(Session::get('takeawayOption') == "true"){ ?> checked <?php } ?>> <span
                                                        class="slider round"></span>
												</span>
                        </div>
                        <?php    }else {?>

                        <div class="icon d-flex align-items-center text-dark takeaway-div">
										<span class="takeaway-btn">
											<i class="fa fa-car h6 mr-1 mb-0"></i> <span> {{trans('lang.delivery')}} </span>
											<input type="checkbox" onclick="takeAwayOnOff(this)"> <span
                                                    class="slider round"></span>
											</span>
                        </div>
                        <?php    }?>
                        <?php }?>
                        <div style="visibility: hidden;"
                             class="language-list icon d-flex align-items-center text-dark ml-2"
                             id="language_dropdown_box">
                            <div class="language-select">
                                <i class="feather-globe"></i>
                            </div>
                            <div class="language-options">
                                <select class="form-control changeLang text-dark" id="language_dropdown"></select>
                            </div>
                        </div>
                        <a class="toggle" href="#">
                            <span></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>
<div class="d-none">
    <div class="bg-primary p-3 d-flex align-items-center">
        <a class="toggle togglew toggle-2" href="#"><span></span></a>
        <a href="{{url('/')}}" class="mobile-logo brand-wrap mb-0">
            <img alt="#" class="img-fluid" src="{{asset('img/logo_web.png')}}">
        </a>
    </div>
</div>
