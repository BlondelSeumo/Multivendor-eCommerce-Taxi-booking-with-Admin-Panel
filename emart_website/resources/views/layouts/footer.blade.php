<button type="button" id="locationModal" data-toggle="modal" data-target="#locationModalAddress" hidden>submit</button>

<div class="modal fade" id="locationModalAddress" tabindex="-1" role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered location_modal">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title locationModalTitle">{{trans('lang.delivery_address')}}</h5>

            </div>

            <div class="modal-body">

                <form class="">

                    <div class="form-row">

                        <div class="col-md-12 form-group">

                            <label class="form-label">{{trans('lang.street_1')}}</label>

                            <div class="input-group">

                                <input placeholder="Delivery Area" type="text" id="address_line1" class="form-control">

                                <div class="input-group-append">
                                    <button onclick="getCurrentLocationAddress1()" type="button" class="btn btn-outline-secondary"><i class="feather-map-pin"></i></button>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12 form-group"><label
                                    class="form-label">{{trans('lang.landmark')}}</label><input
                                    placeholder="{{trans('lang.footer')}}" value=""
                                    id="address_line2" type="text" class="form-control"></div>

                        <div class="col-md-12 form-group"><label
                                    class="form-label">{{trans('lang.zip_code')}}</label><input placeholder="Zip Code"
                                                                                                id="address_zipcode"
                                                                                                type="text"
                                                                                                class="form-control">
                        </div>

                        <div class="col-md-12 form-group"><label class="form-label">{{trans('lang.city')}}</label><input
                                    placeholder="{{trans('lang.city')}}" id="address_city" type="text"
                                    class="form-control"></div>

                        <div class="col-md-12 form-group"><label
                                    class="form-label">{{trans('lang.country')}}</label><input placeholder="Country"
                                                                                               id="address_country"
                                                                                               type="text"
                                                                                               class="form-control">
                        </div>

                        <input type="hidden" name="address_lat" id="address_lat">
                        <input type="hidden" name="address_lng" id="address_lng">
                    </div>

                </form>

            </div>

            <div class="modal-footer p-0 border-0">

                <div class="col-12 m-0 p-0">
                    <button type="button" id="close_button" class="close" data-dismiss="modal" aria-label="Close"
                            hidden>
                        <button type="button" class="btn btn-primary btn-lg btn-block"
                                onclick="saveShippingAddress()">{{trans('lang.save_changes')}}</button>

                </div>

            </div>

        </div>

    </div>

</div>

<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_accepted_order_by_vendor_id" data-toggle="modal"
            data-target="#notification_accepted_order_by_vendor">Large modal</button>
	</span>
<div class="modal fade" id="notification_accepted_order_by_vendor" tabindex="-1" role="dialog"
     aria-labelledby="notification_accepted_order_by_vendor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="exampleModalLongTitle">{{trans('lang.your_order_has_accepted')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><span id="restaurnat_name"></span> {{trans('lang.has_accept_your_order')}}</h6>
            </div>
            <div class="modal-footer">
                <?php if(@$_COOKIE['service_type'] == "Parcel Delivery Service"){ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('parcel_orders')}}" id="notification_accepted_order_by_vendor_a">{{trans('lang.Go')}}</a></button>
            	<?php }else if(@$_COOKIE['service_type'] == "Rental Service"){ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}" id="notification_accepted_order_by_vendor_a">{{trans('lang.Go')}}</a></button>
            	<?php }else{ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('my_order')}}" id="notification_accepted_order_by_vendor_a">{{trans('lang.Go')}}</a></button>
            	<?php } ?>
            </div>
        </div>
    </div>
</div>
<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_rejected_order_by_vendor_id" data-toggle="modal"
            data-target="#notification_rejected_order_by_vendor">Large modal</button>
	</span>
<div class="modal fade" id="notification_rejected_order_by_vendor" tabindex="-1" role="dialog"
     aria-labelledby="notification_accepted_order_by_vendor" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title" id="exampleModalLongTitle">{{trans('lang.your_order_has_rejected')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="driver_name"></h6><h6> {{trans('lang.has_reject_your_order')}}</h6>
            </div>
            <div class="modal-footer">
                <?php if(@$_COOKIE['service_type'] == "Parcel Delivery Service"){ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('parcel_orders')}}" id="notification_rejected_order_by_vendor_a">{{trans('lang.Go')}}</a></button>
            	<?php }else if(@$_COOKIE['service_type'] == "Rental Service"){ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}" id="notification_rejected_order_by_vendor_a">{{trans('lang.Go')}}</a></button>
            	<?php }else{ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('my_order')}}" id="notification_rejected_order_by_vendor_a">{{trans('lang.Go')}}</a></button>
            	<?php } ?>
            </div>
        </div>
    </div>
</div>

<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_accepted_order_id" data-toggle="modal"
            data-target="#notification_accepted_order">Large modal</button>
	</span>
<div class="modal fade" id="notification_accepted_order" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">{{trans('lang.delivery_agent_assigned')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="accept_name"></h6><h6>{{trans('lang.will_deliver_your_order')}}</h6>
            </div>
            <div class="modal-footer">
                <?php if(@$_COOKIE['service_type'] == "Parcel Delivery Service"){ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('parcel_orders')}}" id="notification_accepted_a">{{trans('lang.Go')}}</a></button>
            	<?php }else if(@$_COOKIE['service_type'] == "Rental Service"){ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}" id="notification_accepted_a">{{trans('lang.Go')}}</a></button>
            	<?php }else{ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('my_order')}}" id="notification_accepted_a">{{trans('lang.Go')}}</a></button>
            	<?php } ?>
            </div>
        </div>
    </div>
</div>
<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_order_complete_id" data-toggle="modal"
            data-target="#notification_order_complete">{{trans('lang.large_modal')}}</button>
	</span>
<div class="modal fade" id="notification_order_complete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">{{trans('lang.order_completed')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>{{trans('lang.delivered_order')}}</h6>
            </div>
            <div class="modal-footer">
            	<?php if(@$_COOKIE['service_type'] == "Parcel Delivery Service"){ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('parcel_orders')}}" id="">{{trans('lang.Go')}}</a></button>
            	<?php }else if(@$_COOKIE['service_type'] == "Rental Service"){ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}" id="">{{trans('lang.Go')}}</a></button>
            	<?php }else{ ?>
            		<button type="button" class="btn btn-primary"><a href="{{url('my_order')}}" id="">{{trans('lang.Go')}}</a></button>
            	<?php } ?>
            </div>
        </div>
    </div>
</div>
<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_accepted_dining_by_restaurant_id" data-toggle="modal"
            data-target="#notification_accepted_dining_by_restaurant">{{trans('lang.large_modal')}}</button>
	</span>
<div class="modal fade" id="notification_accepted_dining_by_restaurant" tabindex="-1" role="dialog"
     aria-labelledby="notification_accepted_dining_by_restaurant" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title"
                    id="exampleModalLongTitle">{{trans('lang.your_dining_request_has_accepted')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><span id="restaurnat_name_dining"></span> {{trans('lang.has_accept_your_dining_request')}}</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a href="{{url('my_dinein')}}"
                                                                 id="notification_accepted_dining_by_restaurant_a">{{trans('lang.go')}}</a>
                </button>
            </div>
        </div>
    </div>
</div>


<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_rejected_dining_by_restaurant_id" data-toggle="modal"
            data-target="#notification_rejected_dining_by_restaurant">{{trans('lang.large_modal')}}</button>
	</span>

<div class="modal fade" id="notification_rejected_dining_by_restaurant" tabindex="-1" role="dialog"
     aria-labelledby="notification_rejected_dining_by_restaurant" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title"
                    id="exampleModalLongTitle">{{trans('lang.your_dining_request_has_rejected')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6><span id="restaurnat_name_dining_rejected"></span> {{trans('lang.has_reject_your_dining_request')}}
                </h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a href="{{url('my_dinein')}}"
                                                                 id="notification_rejected_dining_by_restaurant_a">{{trans('lang.go')}}</a>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Store Select Model -->
<div class="modal fade" id="select_store_model" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5>{{trans('lang.select_sections')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="section_list row mt-3" id="section_lists"></div>
            </div>
        </div>
    </div>
</div>

<!-- Rental Notification -->
<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_accepted_order_rental_driver_id" data-toggle="modal"
            data-target="#notification_accepted_order_by_driver">Large modal</button>
	</span>
<div class="modal fade" id="notification_accepted_order_by_driver" tabindex="-1" role="dialog"
     aria-labelledby="notification_accepted_order_by_driver" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center"  style="display: block;">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">{{trans('lang.booking_accepted')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h6 class="driver_name_"></h6> <h6>{{trans('lang.has_accept_booking')}}</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}"
                                                                 id="notification_accepted_rental_a">{{trans('Go')}}</a>
                </button>
            </div>
        </div>
    </div>
</div>
<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_accepted_order_rental_id" data-toggle="modal"
            data-target="#notification_accepted_order_rental">Large modal</button>
	</span>
<div class="modal fade" id="notification_accepted_order_rental" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">{{trans('lang.delivery_agent_assigned')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="driver_name_"></h6><h6>{{trans('lang.will_deliver_your_order')}}</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}"
                                                                 id="notification_accepted_a">Go</a></button>
            </div>
        </div>
    </div>
</div>

<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_order_complete_rental_id" data-toggle="modal"
            data-target="#notification_order_complete_rental">{{trans('lang.large_modal')}}</button>
	</span>
<div class="modal fade" id="notification_order_complete_rental" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="display: block;">
                <h5 class="modal-title text-center" id="exampleModalLongTitle">{{trans('lang.booking_compeleted')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <h6 class="driver_name_"></h6> <h6>{{trans('lang.has_booking_completed')}}</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}"
                    id="">{{trans('lang.Go')}}</a></button>
            </div>
        </div>
    </div>
</div>
<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_rejected_rental_order_id" data-toggle="modal"
            data-target="#notification_rejected_rental_id">{{trans('lang.large_modal')}}</button>
	</span>

<div class="modal fade" id="notification_rejected_rental_id" tabindex="-1" role="dialog"
     aria-labelledby="notification_rejected_dining_by_restaurant" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center" style="display: block;">
                <h5 class="modal-title text-center"
                    id="exampleModalLongTitle">{{trans('lang.booking_rejected')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h6 class="driver_name_"></h6><h6>{{trans('lang.has_booking_rejected')}}
                </h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}"
                    id="notification_rejected_dining_by_restaurant_a">{{trans('lang.go')}}</a>
                </button>
            </div>
        </div>
    </div>
</div>
<span style="display: none;">
	<button type="button" class="btn btn-primary" id="notification_rejected_rental_order_ride_id" data-toggle="modal"
            data-target="#notification_rejected_rental_ride_id">{{trans('lang.large_modal')}}</button>
	</span>

<div class="modal fade" id="notification_rejected_rental_ride_id" tabindex="-1" role="dialog"
     aria-labelledby="notification_rejected_dining_by_restaurant" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered notification-main" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center " style="display: block;">
                <h5 class="modal-title text-center"
                    id="exampleModalLongTitle">{{trans('lang.start_ride')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h6 class="driver_name_"></h6><h6>{{trans('lang.has_start_ride')}}
                </h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary"><a href="{{url('rental_orders')}}"
                    id="notification_rejected_dining_by_restaurant_a">{{trans('lang.go')}}</a>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<footer class="section-footer border-top bg-dark">
    <div class="footerTemplate"></div>
    <div class="select-sec-btn">
        <a href="#" data-toggle="modal" id="select_store_model_call"
           data-target="#select_store_model">{{trans('lang.select_section')}}</a>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript" src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

<script type="text/javascript" src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<?php if(str_replace('_', '-', app()->getLocale()) == 'ar'){ ?>
<script type="text/javascript" src="{{asset('vendor/bootstrap/js/bootstrap-rtl.bundle.min.js')}}"></script>
<?php } ?>

<script type="text/javascript" src="{{asset('vendor/sidebar/hc-offcanvas-nav.js')}}"></script>

<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/siddhi.js')}}"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-firestore.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-storage.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-messaging.js"></script>

<script src="firebase-messaging-sw.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<?php $map_key = env('GOOGLE_MAP_PLACE_API'); ?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_key; ?>&libraries=places"></script>

<script type="text/javascript">@include('vendor_include.init_firebase')</script>

<script type="text/javascript">
    var database = firebase.firestore();
    <?php $id = null; if (Auth::user()) {
        $id = Auth::user()->getvendorId();
    } ?>
    var cuser_id = '<?php echo $id; ?>';
    var dine_in_enable = false;
    var place = [];
    var address_name = getCookie('address_name');
    var address_name1 = getCookie('address_name1');
    var address_name2 = getCookie('address_name2');
    var address_zip = getCookie('address_zip');

    var address_lat = getCookie('address_lat');
    var address_lng = getCookie('address_lng');
    var address_city = getCookie('address_city');
    var address_state = getCookie('address_state');
    var address_country = getCookie('address_country');

    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    var service_type = getCookie('service_type');
    var footerRef = database.collection('settings').doc('footerTemplate');

    footerRef.get().then(async function (snapshots) {
        var footerData = snapshots.data();
        if (footerData != undefined) {
            if (footerData.footerTemplate && footerData.footerTemplate != "" && footerData.footerTemplate != undefined) {
                $('.footerTemplate').html(footerData.footerTemplate);
            }
        }
    });

    if (typeof is_layer == "undefined") {
        google.maps.event.addDomListener(window, 'load', initialize);
    }

    if (typeof is_layer != "undefined") {
        $(".select-sec-btn").hide();
    }

    if (address_name == "" || address_name == null) {
        <?php if(Request::path() !== 'terms' && Request::path() !== 'privacy' && Request::path() !== 'contact-us' && Request::path() !== 'faq'){ ?>
        if (typeof is_layer == "undefined") {
            $('#locationModal').trigger('click');
            $('.locationModalTitle').html('{{trans("lang.find_vendors_items_near_you")}}');
        }
        <?php } ?>
    } else {

        if (getCookie('section_id') == null || getCookie('section_id') == "" || getCookie('section_id') == undefined) {
            <?php if(Request::path() !== 'terms' && Request::path() !== 'privacy' && Request::path() !== 'contact-us' && Request::path() !== 'faq'){ ?>
            if (typeof is_layer == "undefined") {
                $('#select_store_model_call')[0].click();
            }
            <?php } ?>
            if ($("#section_lists").html() == '') {
                var sectionsRef = database.collection('sections').where('isActive', '==', true);

                sectionsRef.get().then(async function (snapshots) {
                    var sections = [];
                    snapshots.docs.forEach((section) => {
                        var datas = section.data();

                        if (datas.sectionImage != '' && datas.sectionImage != undefined) {
                            section_image = datas.sectionImage;
                        } else {
                            section_image = placeholderImage;
                        }

                        html = '<div class="section-list-inner col-md-3 mb-4 select_section" data-color="' + datas.color + '" service_type="' + datas.serviceType + '" data-name="' + datas.name + '" data-dine_in="' + datas.dine_in_active + '" data-id="' + datas.id + '">' +
                            '<div class="section-block bg-white rounded d-block py-3 px-2 text-center shadow-lg">' +
                            '<span class="section-img"><img alt="#" src="' + section_image + '" class="img-fluid item-img w-100"></span>' +
                            '<span class="section-name mt-2 d-block">' + datas.name + '</span></div></div>';
                        $("#section_lists").append(html);

                        sections.push(datas);

                    });
                });

            }

        }
    }

    if (cuser_id != "") {
        var userDetailsRef = database.collection('users').where('id', "==", cuser_id);
    }

    $('#select_store_model_call').bind('click', function () {

        if ($("#section_lists").html() == '') {
            var sectionsRef = database.collection('sections').where('isActive', '==', true);
            var active_section_id = "<?php echo @$_COOKIE['section_id'] ?>";

            sectionsRef.get().then(async function (snapshots) {
                var sections = [];
                snapshots.docs.forEach((section) => {
                    var datas = section.data();

                    if (datas.sectionImage != '' && datas.sectionImage != undefined) {
                        section_image = datas.sectionImage;
                    } else {
                        section_image = placeholderImage;
                    }

                    var active_section = '';
                    if(active_section_id != undefined && active_section_id == datas.id){
                    	active_section = 'section-selected';
                    }

                    html = '<div class="section-list-inner col-md-3 mb-4 select_section '+active_section+'" service_type="' + datas.serviceType + '"data-color="' + datas.color + '" data-name="' + datas.name + '" data-id="' + datas.id + '" data-dine_in="' + datas.dine_in_active + '"><div class="section-block bg-white rounded d-block py-3 px-2 text-center shadow-lg"><span class="section-img"><img alt="#" src="' + section_image + '" class="img-fluid item-img w-100"></span><span class="section-name mt-2 d-block">' + datas.name + '</span></div></div>';

                    $("#section_lists").append(html);
                    sections.push(datas);

                });
            });

        }
    });

    function initialize() {

        if (address_name != '') {
            document.getElementById('user_locationnew').value = address_name;
        }
        var input = document.getElementById('user_locationnew');
        var autocomplete = new google.maps.places.Autocomplete(input);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            address_name = place.name;
            address_lat = place.geometry.location.lat();
            address_lng = place.geometry.location.lng();

            $.each(place.address_components, function (i, address_component) {
                address_name1 = '';
                if (address_component.types[0] == "premise") {
                    if (address_name1 == '') {
                        address_name1 = address_component.long_name;
                    } else {
                        address_name2 = address_component.long_name;
                    }
                } else if (address_component.types[0] == "postal_code") {
                    address_zip = address_component.long_name;
                } else if (address_component.types[0] == "locality") {
                    address_city = address_component.long_name;
                } else if (address_component.types[0] == "administrative_area_level_1") {
                    var address_state = address_component.long_name;
                } else if (address_component.types[0] == "country") {
                    var address_country = address_component.long_name;
                }
            });

            setCookie('address_name1', address_name1, 365);
            setCookie('address_name2', address_name2, 365);
            setCookie('address_name', address_name, 365);
            setCookie('address_lat', address_lat, 365);
            setCookie('address_lng', address_lng, 365);
            setCookie('address_zip', address_zip, 365);
            setCookie('address_city', address_city, 365);
            setCookie('address_state', address_state, 365);
            setCookie('address_country', address_country, 365);
            <?php if(Request::is('/')){ ?>
            if (typeof is_layer == "undefined") {
                callStore();
            }
            <?php } ?>
        });

    }

    async function getCurrentLocationAddress1() {

        var geocoder = new google.maps.Geocoder();
        navigator.geolocation.getCurrentPosition(async function (position) {
            var address_city = "";
            var address_country = "";
            var address_state = "";
            var address_street = "";
            var address_street2 = "";
            var address_street3 = "";
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });


            var location = new google.maps.LatLng(pos['lat'], pos['lng']);     // turn coordinates into an object

            geocoder.geocode({'latLng': location}, async function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {

                    if (results.length > 0) {
                        document.getElementById('user_locationnew').value = results[0].formatted_address;
                        address_name1 = '';
                        $.each(results[0].address_components, async function (i, address_component) {

                            address_name1 = '';
                            if (address_component.types[0] == "premise") {
                                if (address_name1 == '') {
                                    address_name1 = address_component.long_name;
                                } else {
                                    address_name2 = address_component.long_name;
                                }
                            } else if (address_component.types[0] == "postal_code") {
                                address_zip = address_component.long_name;
                            } else if (address_component.types[0] == "locality") {
                                address_city = address_component.long_name;
                            } else if (address_component.types[0] == "administrative_area_level_1") {
                                address_state = address_component.long_name;
                            } else if (address_component.types[0] == "country") {
                                address_country = address_component.long_name;
                            } else if (address_component.types[0] == "street_number") {
                                address_street = address_component.long_name;
                            } else if (address_component.types[0] == "route") {
                                address_street2 = address_component.long_name;
                            } else if (address_component.types[0] == "political") {
                                address_street3 = address_component.long_name;
                            }
                        });

                        address_lat = results[0].geometry.location.lat();
                        address_lng = results[0].geometry.location.lng();

                        $("#address_lat").val(address_lat);
                        $("#address_lng").val(address_lng);

                        if (results[0].formatted_address) {
                            $("#address_line1").val(results[0].formatted_address);
                        } else {
                            $("#address_line1").val(address_street + ", " + address_street2);
                        }
                        $("#address_line2").val(address_street3);
                        $("#address_city").val(address_city);
                        $("#address_country").val(address_country);
                        $("#address_zipcode").val(address_zip);
                    }

                }

            });
            try {

            } catch (err) {

            }

        }, function () {

        });
    }

<?php if(@Route::current()->getName() == 'checkout'){ ?>

    google.maps.event.addDomListener(window, 'load', initializeCheckout);

    function initializeCheckout() {

        if (address_name != '') {
            document.getElementById('address_line1').value = address_name;

        }
        var input = document.getElementById('address_line1');
        var autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {

            var place = autocomplete.getPlace();
            address_name = place.name;
            address_lat = place.geometry.location.lat();
            address_lng = place.geometry.location.lng();
            $.each(place.address_components, function (i, address_component) {
                address_name1 = '';

                if (address_component.types[0] == "premise") {
                    if (address_name1 == '') {
                        address_name1 = address_component.long_name;
                    } else {
                        address_name2 = address_component.long_name;
                    }
                } else if (address_component.types[0] == "postal_code") {
                    address_zip = address_component.long_name;
                } else if (address_component.types[0] == "locality") {
                    address_city = address_component.long_name;
                } else if (address_component.types[0] == "administrative_area_level_1") {
                    var address_state = address_component.long_name;
                } else if (address_component.types[0] == "country") {
                    var address_country = address_component.long_name;
                }
            });

            $("#address_line2").val(address_name2);
            $("#address_lat").val(address_lat);
            $("#address_lng").val(address_lng);
            $("#address_line2").val(address_name2);
            $("#address_city").val(address_city);
            $("#address_country").val(address_country);
            $("#address_zipcode").val(address_zip);
        });

    }

<?php } ?>

    async function getCurrentLocation(type = '') {
        var geocoder = new google.maps.Geocoder();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var geolocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });

                var location = new google.maps.LatLng(pos['lat'], pos['lng']);
                geocoder.geocode({'latLng': location}, async function (results, status) {

                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results.length > 0) {
                            document.getElementById('user_locationnew').value = results[0].formatted_address;
                            address_name1 = '';
                            $.each(results[0].address_components, async function (i, address_component) {
                                address_name1 = '';
                                if (address_component.types[0] == "premise") {
                                    if (address_name1 == '') {
                                        address_name1 = address_component.long_name;
                                    } else {
                                        address_name2 = address_component.long_name;
                                    }
                                } else if (address_component.types[0] == "postal_code") {
                                    address_zip = address_component.long_name;
                                } else if (address_component.types[0] == "locality") {
                                    address_city = address_component.long_name;
                                } else if (address_component.types[0] == "administrative_area_level_1") {
                                    var address_state = address_component.long_name;
                                } else if (address_component.types[0] == "country") {
                                    var address_country = address_component.long_name;
                                }
                            });

                            address_name = results[0].formatted_address;
                            address_lat = results[0].geometry.location.lat();
                            address_lng = results[0].geometry.location.lng();

                            setCookie('address_name1', address_name1, 365);
                            setCookie('address_name2', address_name2, 365);
                            setCookie('address_name', address_name, 365);
                            setCookie('address_lat', address_lat, 365);
                            setCookie('address_lng', address_lng, 365);
                            setCookie('address_zip', address_zip, 365);
                            setCookie('address_city', address_city, 365);
                            setCookie('address_state', address_state, 365);
                            setCookie('address_country', address_country, 365);

                            if (type == 'reload') {
                                window.location.reload(true);
                            }
                        }
                    }
                });
                try {
                    if (autocomplete) {
                        autocomplete.setBounds(circle.getBounds());
                    }
                } catch (err) {

                }

            }, function () {

            });
        } else {
            // Browser doesn't support Geolocation
        }
    }

    function saveShippingAddress() {

        var line1 = $("#address_line1").val();
        var line2 = $("#address_line2").val();
        var city = $("#address_city").val();
        var country = $("#address_country").val();
        var postalCode = $("#address_zipcode").val();
        var full_address = '';

        if (cuser_id != "") {

            userDetailsRef.get().then(async function (userSnapshots) {

                var userDetails = userSnapshots.docs[0].data();

                if (userDetails.hasOwnProperty('shippingAddress')) {
                    var shippingAddress = userDetails.shippingAddress;

                    shippingAddress.line1 = $("#address_line1").val();
                    shippingAddress.line2 = $("#address_line2").val();
                    shippingAddress.city = $("#address_city").val();
                    shippingAddress.country = $("#address_country").val();
                    shippingAddress.postalCode = $("#address_zipcode").val();
                } else {
                    var shippingAddress = [];
                    var shippingAddress = {
                        "line1": line1,
                        "line2": line2,
                        "city": city,
                        "country": country,
                        "postalCode": postalCode
                    };
                }


                setCookie('address_name1', line1, 365);
                setCookie('address_name2', line2, 365);
                setCookie('address_lat', jQuery("#address_lat").val(), 365);
                setCookie('address_lng', jQuery("#address_lng").val(), 365);
                setCookie('address_zip', postalCode, 365);
                setCookie('address_city', city, 365);
                setCookie('address_country', country, 365);
                if (line1 != "") {
                    full_address = line1;
                }
                if (line2 != "") {
                    full_address = full_address + ',' + line2;
                }
                if (postalCode != "") {
                    full_address = full_address + ',' + postalCode;
                }
                if (city != "") {
                    full_address = full_address + ',' + city;
                }
                if (country != "") {
                    full_address = full_address + ',' + country;
                }
                setCookie('address_name', full_address, 365);
                database.collection('users').doc(cuser_id).update({'shippingAddress': shippingAddress}).then(function (result) {

                    $('#close_button').trigger("click");
                    location.reload();
                });

            });

        } else {
            setCookie('address_name1', line1, 365);
            setCookie('address_name2', line2, 365);
            setCookie('address_lat', jQuery("#address_lat").val(), 365);
            setCookie('address_lng', jQuery("#address_lng").val(), 365);
            setCookie('address_zip', postalCode, 365);
            setCookie('address_city', city, 365);
            setCookie('address_country', country, 365);

            if (line1 != "") {
                full_address = line1;
            }
            if (line2 != "") {
                full_address = full_address + ',' + line2;
            }
            if (postalCode != "") {
                full_address = full_address + ',' + postalCode;
            }
            if (city != "") {
                full_address = full_address + ',' + city;
            }
            if (country != "") {
                full_address = full_address + ',' + country;
            }
            setCookie('address_name', full_address, 365);
            $('#close_button').trigger("click");
            location.reload();
        }
    }

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function deleteCookie(name) {
    	document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
</script>

<script type="text/javascript">

    <?php
    use App\Models\user;
    use App\Models\VendorUsers;
    $user_email = '';
    $user_uuid = '';
    $auth_id = Auth::id();
    if ($auth_id) {
        $user = user::select('email')->where('id', $auth_id)->first();
        $user_email = $user->email;
        $user_uuid = VendorUsers::select('uuid')->where('email', $user_email)->first();
        $user_uuid = $user_uuid->uuid;
    }
    ?>

    var database = firebase.firestore();

    var placeholderImageHeader = '';
    var googleMapKeySettingHeader = database.collection('settings').doc("googleMapKey");
    googleMapKeySettingHeader.get().then(async function (googleMapKeySnapshotsHeader) {
        var placeholderImageHeaderData = googleMapKeySnapshotsHeader.data();
        placeholderImageHeader = placeholderImageHeaderData.placeHolderImage;
    })

    var user_email = "<?php echo $user_email;  ?>";
    var user_ref = '';
    if (user_email != '') {
        var user_uuid = "<?php echo $user_uuid; ?>";
        user_ref = database.collection('users').where("id", "==", user_uuid);
    }

    var ref = database.collection('settings').doc("globalSettings");
    ref.get().then(async function (snapshots) {
        var globalSettings = snapshots.data();
        $("#logo_web").attr('src', globalSettings.appLogo);
        $("#footer_logo_web").attr('src', globalSettings.appLogo);
    });

    $(document).ready(function () {
        jQuery("#data-table_processing").show();
        if (user_ref != '') {
            user_ref.get().then(async function (profileSnapshots) {
                if (profileSnapshots.docs.length) {
                    var profile_user = profileSnapshots.docs[0].data();
                    var profile_name = profile_user.firstName + " " + profile_user.lastName;
                    if (profile_user.profilePictureURL != '') {
                        $("#dropdownMenuButton").append('<img alt="#" src="' + profile_user.profilePictureURL + '" class="img-fluid rounded-circle header-user mr-2 header-user">Hi ' + profile_user.firstName);
                    } else {
                        $("#dropdownMenuButton").append('<img alt="#" src="' + placeholderImage + '" class="img-fluid rounded-circle header-user mr-2 header-user">Hi ' + profile_user.firstName);
                    }

                    if (profile_user.shippingAddress) {
                        $("#user_location").html(profile_user.shippingAddress.city);
                    }
                }
            })
        }
    })


    $(".user-logout-btn").click(async function () {
        firebase.auth().signOut().then(function () {
            var logoutURL = "{{route('logout')}}";
            $.ajax({
                type: 'POST',
                url: logoutURL,
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data1) {
                    if (data1.logoutuser) {
                        window.location = "{{ route('login')}}";
                    }
                }
            })
        });
    });


    $(document).ready(function () {

        <?php if(isset($_COOKIE['section_id'])){  ?>
	        /*var section_id = "<?php echo $_COOKIE['section_id'] ?>";
		    console.log("section_id == " + section_id);
		    var refDineInSection = database.collection('sections').doc(section_id);
		
		    refDineInSection.get().then(async function (snapshotsDinein) {
		        var enableddineinSection = snapshotsDinein.data();
		        dine_in_active = enableddineinSection.dine_in_active;
		        if (dine_in_active == true) {
		            $(".dine_in_menu").show();
		            $(".dine_in_menu").attr('style', 'display: block !important');
		        }
		    })*/
        	<?php if(isset($_COOKIE['dine_in_active']) && $_COOKIE['dine_in_active'] == 'true'){ ?>
        		$(".dine_in_menu").show();
        		$(".dine_in_menu").attr('style', 'display: block !important');
        	<?php } ?>
        <?php }?>

        $(document).on("click", ".select_section", function (e) {
            var section_id = $(this).attr('data-id');
            var section_name = $(this).attr('data-name');
            var section_color = $(this).attr('data-color');
            var dine_in_active = $(this).attr('data-dine_in');
            var service_type = $(this).attr('service_type');
            if (dine_in_active != 'true') {
                dine_in_active = 'false';
            }
            setCookie('section_id', section_id, 365);
            setCookie('section_name', section_name, 365);
            setCookie('section_color', section_color, 365);
            setCookie('dine_in_active', dine_in_active.toString(), 365);
            setCookie('service_type', service_type, 365);
            window.location.href = "<?php echo url('/'); ?>";
        });
    });

</script>


<script type="text/javascript" src="{{asset('js/rocket-loader.min.js')}}"></script>

<script type="text/javascript" src="{{asset('https://static.cloudflareinsights.com/beacon.min.js')}}"></script>

<?php if(Auth::user()){ ?>

<script type="text/javascript">
    var route1 = '<?php echo route('my_order'); ?>';
    var routeparcel = '<?php echo route('parcel_orders');?>';
    var routerental = '<?php echo route('rental_orders');?>';

    var database = firebase.firestore();
    var pageloadded = 0;
    database.collection('vendor_orders').where('author.id', "==", cuser_id).onSnapshot(function (doc) {
        if (pageloadded) {
            doc.docChanges().forEach(function (change) {
                val = change.doc.data();

                if (change.type == "modified") {
                    if (val.status == "Order Completed") {
                        $("#notification_order_complete_id").trigger("click");
                    } else if (val.status == "Order Accepted") {
                        if (val.vendor.title) {
                            $("#restaurnat_name").text(val.vendor.title);
                        }
                        if (route1) {
                            $("#notification_accepted_order_by_vendor_a").attr("href", route1);
                        }
                        $("#notification_accepted_order_by_vendor_id").trigger("click");
                    } else if (val.status == "Driver Pending" || val.status == "Driver Accepted") {
                        if (val.driver && val.driver.firstName) {
                            $("#np_accept_name").text(val.driver.firstName);
                        }
                        if (route1) {
                            $("#notification_accepted_a").attr("href", route1.replace(':id', val.id));
                        }
                        $("#notification_accepted_order").modal('show');
                        $("#notification_accepted_order_id").trigger("click");
                    } else if (val.status == "Order Rejected") {
                        if (val.vendor.title) {
                            $("#restaurnat_name_1").text(val.vendor.title);
                        }
                        if (route1) {
                            $("#notification_rejected_order_by_vendor_a").attr("href", route1);
                        }
                        $("#notification_rejected_order_by_vendor_id").trigger("click");
                    }
                }

            });
        } else {
            pageloadded = 1;
        }
    });

    database.collection('parcel_orders').where('author.id', "==", cuser_id).onSnapshot(function (doc) {
        if (pageloadded) {
            doc.docChanges().forEach(function (change) {
                val = change.doc.data();
                if (change.type == "modified") {
                    if (val.status == "Order Completed") {
                        $("#notification_order_complete_id").trigger("click");
                    }  else if (val.status == "Driver Pending" || val.status == "Driver Accepted") {
                            const driverData = getDriver(val.driverID);
                        if (routeparcel) {
                            $("#notification_accepted_a").attr("href", routeparcel.replace(':id', val.id));
                        }
                        $("#notification_accepted_order").modal('show');
                        $("#notification_accepted_order_id").trigger("click");
                    } else if (val.status == "Order Rejected") {
                        if (val.driverID) {
			                 const driverData = getDriver(val.driverID);
                        }
                        if (routeparcel) {
                            $("#notification_rejected_order_by_vendor_a").attr("href", routeparcel);
                        }
                        $("#notification_rejected_order_by_vendor_id").trigger("click");
                    }
                }

            });
        } else {
            pageloadded = 1;
        }
    });

    database.collection('rental_orders').where('author.id', "==", cuser_id).onSnapshot(function (doc) {
        if (pageloadded) {
            doc.docChanges().forEach(function (change) {
                val = change.doc.data();

                if (change.type == "modified") {

                    if (val.status == "Order Completed" ) {
                        const driverData = getRentalDriver(val.driverID);
				        $("#notification_order_complete_rental_id").trigger("click");
                    }  else if (val.status == "Driver Pending" || val.status == "Driver Accepted") {
				         const driverData = getRentalDriver(val.driverID);
                        if (routerental) {
                            $("#notification_accepted_rental_a").attr("href", routerental.replace(':id', val.id));
                        }
                        $("#notification_accepted_order_by_driver").modal('show');
                        $("#notification_accepted_order_rental_driver_id").trigger("click");
                    }
                    else if (val.status == "In Transit") {

                       const driverData = getRentalDriver(val.driverID);


                   $("#notification_rejected_rental_ride_id").modal('show');
                   $("#notification_rejected_rental_order_ride_id").trigger("click");
               }else if (val.status == "Order Rejected") {
                        if (val.driver.firstName) {
                            $('.driver_name_').html(val.driver.firstName);
                        }
                        if (routerental) {
                            $("#notification_rejected_order_by_rental").attr("href", routerental);
                        }
                        $("#notification_rejected_rental_id").modal('show');
                        $("#notification_rejected_rental_order_id").trigger("click");

                    }
                }

            });
        } else {
            pageloadded = 1;
        }
    });
    var route2 = '<?php echo route('my_dinein'); ?>';
    var pageloadded_dining = 0;
    database.collection('booked_table').where('author.id', "==", cuser_id).onSnapshot(function (doc) {
        if (pageloadded_dining) {
            doc.docChanges().forEach(function (change) {
                val = change.doc.data();
                if (change.type == "modified") {

                    if (val.status == "Order Accepted") {
                        if (val.vendor.title) {
                            $("#restaurnat_name_dining").text(val.vendor.title);
                        }
                        if (route1) {
                            $("#notification_accepted_dining_by_restaurant_a").attr("href", route2);
                        }
                        $("#notification_accepted_dining_by_restaurant_id").trigger("click");
                    } else if (val.status == "Order Rejected") {
                        if (val.vendor.title) {
                            $("#restaurnat_name_dining_rejected").text(val.vendor.title);
                        }
                        if (route1) {
                            $("#notification_rejected_dining_by_restaurant_a").attr("href", route2);
                        }
                        $("#notification_rejected_dining_by_restaurant_id").trigger("click");
                    }
                }

            });
        } else {
            pageloadded_dining = 1;
        }
    });

    async function getDriver(driverData) {
        var rideDetails = '';
        var client_name = '';
        await database.collection('users').where("id", "==", driverData).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var ride_data = snapshotss.docs[0].data();
                client_name = ride_data.firstName;
                $('.accept_name').html($("<span id='np_accept_name'></span>").text(client_name));
                $('.driver_name').html($("<span id='restaurnat_name_1'></span>").text(client_name));
            } else {
                $('.accept_name').html($("<span id='np_accept_name'></span>").text(''));
                $('.driver_name').html($("<span id='restaurnat_name_1'></span>").text(''));


            }
        });
        return client_name;
    }
    async function getRentalDriver(driverData) {
        var rideDetails = '';
        var client_name = '';
        $('.driver_name_').empty('');
        await database.collection('users').where("id", "==", driverData).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var ride_data = snapshotss.docs[0].data();
                client_name = ride_data.firstName;
                $('.accept_name_').html($("<span id='np_accept_name'></span>").text(client_name));
                $('.driver_name_').html($("<span id='rental_name_2'></span>").text(client_name));
            } else {
                $('.accept_name_').html($("<span id='np_accept_name'></span>").text(''));
                $('.driver_name_').html($("<span id='restaurnat_name_2'></span>").text(''));
            }
        });
        return client_name;
    }

</script>

<?php } ?>

<script type="text/javascript">
    var langcount = 0;
    var languages_list_main = [];
    var languages_list = database.collection('settings').doc('languages');
    languages_list.get().then(async function (snapshotslang) {
        snapshotslang = snapshotslang.data();
        if (snapshotslang != undefined) {
            snapshotslang = snapshotslang.list;
            languages_list_main = snapshotslang;
            snapshotslang.forEach((data) => {
                if (data.isActive == true) {
                    langcount++;
                    $('#language_dropdown').append($("<option></option>").attr("value", data.slug).text(data.title));
                }
            });
            if (langcount > 1) {
                $("#language_dropdown_box").css('visibility', 'visible');
            }
            <?php if(session()->get('locale')){ ?>
            $("#language_dropdown").val("<?php echo session()->get('locale'); ?>");
            <?php } ?>

        }
    });

    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function () {
        var slug = $(this).val();
        languages_list_main.forEach((data) => {
            if (slug == data.slug) {
                if (data.is_rtl == undefined) {
                    setCookie('is_rtl', 'false', 365);
                } else {
                    setCookie('is_rtl', data.is_rtl.toString(), 365);
                }
                window.location.href = url + "?lang=" + slug;
            }
        });
    });

    $(document).ready(function(){
    	//navigation menu settings
		var $main_nav = $('#main-nav');
	    var $toggle = $('.toggle');
	    var defaultOptions = {
	        disableAt: false,
	        customToggle: $toggle,
	        levelSpacing: 40,
	        navTitle: '<?php echo @$_COOKIE['section_name'] ?> - <?php echo env('APP_NAME'); ?>',
	        levelTitles: true,
	        levelTitleAsBack: true,
	        pushContent: '#container',
	        insertClose: 2
	    };
		var Nav = $main_nav.hcOffcanvasNav(defaultOptions);
	});

</script>
