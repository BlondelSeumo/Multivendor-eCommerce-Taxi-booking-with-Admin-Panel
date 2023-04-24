@include('layouts.app')

@include('layouts.header')

<div class="siddhi-home-page">
    <div class="bg-primary px-3 d-none mobile-filter pb-3">
        <div class="row align-items-center">
            <div class="input-group rounded shadow-sm overflow-hidden col-md-9 col-sm-9">
                <div class="input-group-prepend">
                    <button class="border-0 btn btn-outline-secondary text-dark bg-white btn-block"><i
                                class="feather-search"></i></button>
                </div>
                <input type="text" class="shadow-none border-0 form-control" placeholder="Search for vendors or dishes">
            </div>
            <div class="text-white col-md-3 col-sm-3">
                <div class="title d-flex align-items-center">
                    <a class="text-white font-weight-bold ml-auto" data-toggle="modal" data-target="#exampleModal"
                       href="#">{{trans('lang.filter')}}</a>
                </div>
            </div>


        </div>
    </div>


    <!-- /************************rental login****************/ -->

    <div class="rental-login">

        <div class="rental-login-inner">

            <div class="container">

                <div class="rental-login-form">
                    <h3 class="text-center">Luxury Car Rental</h3>
                    <div class="rental-login-form-inner">
                        <div class="row align-items-center form-row drop-check">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <span class="switch-label noData"
                                          style="display: none;">{{trans('lang.drop_off_same_location')}}</span>

                                </div>
                            </div>
                        </div>

                        <div class="form-row row">
                            <div class="col-sm-12">
                                <div class="form-check bg-dark">
                          <span class="switch-label">{{trans('lang.book_with_driver')}}
                            <small>{{trans('lang.dont_have_driver')}}</small>
                            </span>
                                    <label class="switch">
                                        <input type="checkbox" class="isDriver">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center form-row">

                            <div class="col-sm-12">
                                <label style="color: white">{{trans('lang.pickup_dropoff_date')}}</label>
                                <input type="text" name="driverDates" class="form-control driverDates">
                            </div>
                        </div>

                        <div class="row align-items-center form-row">
                            <div class="col-sm-6">
                                <label style="color: white">{{trans('lang.pickup_time')}}</label>
                                <input type="time" class="form-control startTime">

                            </div>
                            <div class="col-sm-6">
                                <label style="color: white">{{trans('lang.dropoff_time')}}</label>
                                <input type="time" class="form-control endTime"
                                       placeholder="{{trans('lang.end_time')}}">
                            </div>
                        </div>

                        <div class="row align-items-center form-row">
                            <div class="col-sm-12">
                                <label style="color: white">{{trans('lang.pickup_location')}}</label>
                                <input type="text" class="form-control pickLocation" id="pickLocation"
                                       placeholder="Pick-up location" onchange="pickLocation()">
                            </div>

                        </div>

                        <div class="row align-items-center form-row drop-check">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <span class="switch-label">{{trans('lang.drop_off_same_location')}}</span>
                                    <label class="switch">
                                        <input type="checkbox" class="isDropSameLocation">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center form-row dropOffDiv">
                            <div class="col-sm-12">
                                <label style="color: white">{{trans('lang.dropoff_location')}}</label>
                                <input type="text" class="form-control dropLocation" id="dropLocation"
                                       placeholder="Drop-off location" onchange="dropLocation()">
                            </div>

                        </div>

                        <div class="row align-items-center form-row form-btn">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-primary" id="find_car">{{trans('lang.find_car')}}
                                </button>
                            </div>
                        </div>

                    </div>

                </div>


            </div>

        </div>
    </div>


    <!-- /************************rental login****************/ -->


</div>

@include('layouts.footer')
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<script type="text/javascript">

    var geoFirestore = new GeoFirestore(firestore);
    var database = firebase.firestore();
    $('input[name="driverDates"]').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY',


        },
        minDate: new Date()
    });

    pickLocation();
    dropLocation();

    var address_lat = "";
    var address_lng = "";
    var drop_address_lat = "";
    var drop_address_lng = "";

    var rentalVehicleType = false;
    var rentalVehicleTypeRef = database.collection('rental_vehicle_type');
    rentalVehicleTypeRef.get().then(async function (snapshots) {
        if (snapshots.docs.length > 0) {
            rentalVehicleType = true;
        }
    });

    function pickLocation() {


        var input = document.getElementById('pickLocation');
        var autocomplete = new google.maps.places.Autocomplete(input);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            address_lat = place.geometry.location.lat();
            address_lng = place.geometry.location.lng();

        });

    }

    function dropLocation() {


        var input = document.getElementById('dropLocation');
        var autocomplete = new google.maps.places.Autocomplete(input);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();

            drop_address_lat = place.geometry.location.lat();
            drop_address_lng = place.geometry.location.lng();

        });

    }

    $(document).on('change', '.isDropSameLocation', function () {

        if ($(this).is(':checked') == true) {
            $('.dropOffDiv').hide();
        } else {
            $('.dropOffDiv').show();
        }
    });


    $(document).on('click', '#find_car', function () {
        var isDriver = $('.isDriver').is(':checked');
        var startEndDate = $('.driverDates').val();
        var startTime = $('.startTime').val();
        var endTime = $('.endTime').val();
        var pickLocation = $('.pickLocation').val();
        var dropLocation = $('.dropLocation').val();
        var isDropSameLocation = $('.isDropSameLocation').is(':checked');

        startEndDate = startEndDate.split('-');
        var startDate = $.trim(startEndDate[0]);
        var endDate = $.trim(startEndDate[1]);

        if (isDropSameLocation == true) {

            dropLocation = pickLocation;
            drop_address_lat = address_lat;
            drop_address_lng = address_lng;
        }

        var dt = new Date();
        var currentTime = dt.getHours() + ":" + dt.getMinutes();

        var currentDate = dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();
        $('.noData').show();
        $('.noData').html("");

        if (startTime == "" || endTime == "") {

            $('.noData').html("{{trans('lang.start_end_time_error')}}");
            window.scroll(0, 0);

        } else if (currentDate == startDate && currentDate == endDate && startTime < currentTime) {


            $('.noData').html("{{trans('lang.start_greater_time_error')}}");
            window.scroll(0, 0);

        } else if ((currentDate == startDate && currentDate == endDate) && (startTime > endTime || endTime < startTime)) {

            $('.noData').html("{{trans('lang.start_end_greater_time_error')}}");
            window.scroll(0, 0);

        } else if (pickLocation == "") {

            $('.noData').html("{{trans('lang.pickup_location_error')}}");
            window.scroll(0, 0);

        } else if (isDropSameLocation == false && dropLocation == "") {

            $('.noData').html("{{trans('lang.dropoff_location_error')}}");
            window.scroll(0, 0);

        } else {
            $('.noData').html("");
            if (rentalVehicleType) {

                var rentalServiceDriverRef = "";

                rentalServiceDriverRef = geoFirestore.collection('users').where("role", "==", "driver").where('serviceType', '==', "rental-service").near({
                    center: new firebase.firestore.GeoPoint(address_lat, address_lng),
                    radius: 100
                }).limit(200);


                rentalServiceDriverRef.get().then(async function (snapShots) {

                    if (snapShots.docs.length > 0) {

                        var checkFlag = true;
                        var count = 0;
                        snapShots.docs.forEach((listval) => {

                            var data = listval.data();

                            if (data.rentalBookingDate && data.rentalBookingDate.length > 0 && data.rentalBookingDate != null && data.rentalBookingDate != "") {

                                for (var i = 0; i < data.rentalBookingDate.length; i++) {
                                    var rentalBookingDate = data.rentalBookingDate[i].toDate().toDateString();
                                    rentalBookingDate = new Date(rentalBookingDate);

                                    rentalBookingDate = rentalBookingDate.getDate() + '/' + (rentalBookingDate.getMonth() + 1) + '/' + rentalBookingDate.getFullYear();

                                    if ((rentalBookingDate <= startDate && rentalBookingDate >= startDate) || (rentalBookingDate <= endDate && rentalBookingDate >= endDate)) {
                                        checkFlag = false;
                                    }
                                }
                                if (checkFlag == false) {
                                    count++;
                                }

                            }
                        });

                        if (snapShots.docs.length > count) {
                            $.ajax({

                                type: 'POST',

                                url: "<?php echo route('find_rental_cars'); ?>",

                                data: {
                                    _token: '<?php echo csrf_token(); ?>',
                                    isDriver: isDriver,
                                    startDate: startDate,
                                    endDate: endDate,
                                    startTime: startTime,
                                    endTime: endTime,
                                    pickLocation: pickLocation,
                                    dropLocation: dropLocation,
                                    isDropSameLocation: isDropSameLocation,
                                    address_lat: address_lat,
                                    address_lng: address_lng,
                                    drop_address_lat: drop_address_lat,
                                    drop_address_lng: drop_address_lng

                                },

                                success: function (data) {

                                    data = JSON.parse(data);

                                    var url = "{{route('rental_cars')}}";
                                    window.location.href = url;

                                }

                            });
                        } else {
                            $('.noData').show();
                            $('.noData').html("No Car Found for this date period!!");
                            window.scroll(0, 0);
                        }
                    } else {
                        $('.noData').show();
                        $('.noData').html("No Car Found in this Location!!");
                        window.scroll(0, 0);
                    }
                });

            } else {
                $('.noData').show();
                $('.noData').html("No Rental Vehicle Found!!");
                window.scroll(0, 0);
            }

        }

    });

</script>

@include('layouts.nav')



