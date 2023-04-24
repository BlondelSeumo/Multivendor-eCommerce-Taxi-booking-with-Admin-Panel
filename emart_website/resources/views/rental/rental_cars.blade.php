@include('layouts.app')

@include('layouts.header')

<?php
session_start();

?>
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

    <!-- /************************Rental List****************/ -->

    <div class="rental-list-page pt-0">

        <div class="rental-list-top p-4 bg-white mb-4 pt-5">
            <div class="container">
                <div class="list-advance-search d-flex row pb-3">
                    <div class="col-md-3">
                        <input type="hidden" id="carRate" value="0"/>
                        <input type="hidden" id="driverRate" value="0"/>
                        <input type="hidden" id="tax" value=""/>
                        <input type="hidden" id="taxLabel" value=""/>
                        <input type="hidden" id="taxType" value=""/>
                        <input type="hidden" id="adminCommission" value=""/>
                        <input type="hidden" id="adminCommissionType" value=""/>

                        <input type="text" name="pick-up-date" placeholder="Pick-up date"
                               class="form-control date_picker pick-up-date"
                               value="<?php
                               if (@$rentalCarsData && @$rentalCarsData['startDate']) {
                                   echo $rentalCarsData['startDate'];
                               }?>" id="pick-up-date">

                    </div>
                    <div class="col-md-3">
                        <input type="text" name="drop-off-date" placeholder="Drop-off date"
                               class="form-control date_picker drop-off-date"
                               value="<?php
                               if (@$rentalCarsData && @$rentalCarsData['endDate']) {
                                   echo $rentalCarsData['endDate'];
                               }?>" id="drop-off-date">
                    </div>
                    <div class="col-md-3">
                        <input type="time" class="form-control startTime" value="<?php
                        if (@$rentalCarsData && @$rentalCarsData['startTime']) {
                            echo $rentalCarsData['startTime'];
                        }?>">

                    </div>
                    <div class="col-md-3">
                        <input type="time" class="form-control endTime" value="<?php
                        if (@$rentalCarsData && @$rentalCarsData['endTime']) {
                            echo $rentalCarsData['endTime'];
                        }?>">


                    </div>
                </div>
                <div class="list-advance-search d-flex row pb-3">
                    <div class="col-md-3">
                        <input type="text" name="pickup-location" placeholder="Pickup location"
                               class="form-control pickLocation" id="pickLocation"
                               value="<?php
                               if (@$rentalCarsData && @$rentalCarsData['pickLocation']) {
                                   echo $rentalCarsData['pickLocation'];
                               }?>" onchange="pickLocation()">
                    </div>

                    <?php
                    $dropOffDiv = "";
                    if (@$rentalCarsData && @$rentalCarsData['isDropSameLocation'] == "true") {
                        $dropOffDiv = 'style="display:none"';
                    }
                    ?>
                    <div class="col-md-3 dropOffDiv <?php echo $dropOffDiv;?>">
                        <input type="text" name="pickup-location" placeholder=" location"
                               class="form-control dropLocation" id="dropLocation"
                               value="<?php
                               if (@$rentalCarsData && @$rentalCarsData['dropLocation']) {
                                   echo $rentalCarsData['dropLocation'];
                               }?>" onchange="dropLocation()">
                    </div>

                    <div class="col-md-1 search-btn">
                        <button type="button" class="btn btn-primary" id="find_car" onclick="findCar()">Search</button>
                    </div>
                </div>


                <div class="rental-list-top-btn border-top pt-3">
                    <div class="rental-top-btn-inner d-flex row">
                        <div class="col-sm-6">
                            <div class="form-check">
                                <span class="switch-label">Book With Driver</span>
                                <label class="switch">

                                    <?php
                                    $isDriver = "";
                                    if (@$rentalCarsData && @$rentalCarsData['isDriver'] == "true") {
                                        $isDriver = "checked";
                                    }?>
                                    <input type="checkbox" class="isDriver" <?php echo $isDriver;?> onclick="findCar()">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-6 text-right">
                            <div class="form-check">
                                <span class="switch-label">Drop off at same location</span>
                                <label class="switch">
                                    <?php
                                    $isDropSameLocation = "";
                                    if (@$rentalCarsData && @$rentalCarsData['isDropSameLocation'] == "true") {
                                        $isDropSameLocation = "checked";
                                    }?>

                                    <input type="checkbox" class="isDropSameLocation"
                                           <?php echo $isDropSameLocation;?> onclick="findCar()">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="rental-list-section">

            <div class="container">
                <div style="display: none;" class="coupon_code_copied_div mt-4 error_top text-center noData"><p>No Car
                        Found in
                        this Location..</p></div>
                <div class="row showCarDiv" style="display: none">
                    <div class="col-md-3 rental-list-left">
                        <div class="rental-left-box">
                            <h3>Car type</h3>
                            <!-- Tabs nav -->
                            <div class="rental-nav-box">
                                <div class="nav flex-column nav-pills nav-pills-custom car_type_div" id="v-pills-tab"
                                     role="tablist"
                                     aria-orientation="vertical">

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-9 rental-list-right">
                        <!-- Tabs content -->
                        <div class="tab-content car_type_detail_div" id="v-pills-tabContent">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /************************Rental List****************/ -->
</div>

<div id="data-table_processing_order" class="dataTables_processing panel panel-default" style="display: none;">
    {{trans('lang.processing')}}
</div>

@include('layouts.footer')
<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"></script>
<link rel="stylesheet" type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css"/>


<script type="text/javascript">

    var database = firebase.firestore();
    var geoFirestore = new GeoFirestore(firestore);

    var html = '';

    $(function () {
        $('#pick-up-date').datepicker({format: 'DD/MM/YYYY', startDate: '-0m'});
        $('#drop-off-date').datepicker({format: 'DD/MM/YYYY', startDate: '-0m'});
    });


    var currentCurrency = '';
    var currencyAtRight = false;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);

    var section_id = getCookie('section_id');
    var reftaxSetting = database.collection('sections').where("id", "==", section_id);

    reftaxSetting.get().then(async function (snapshots) {
        taxData = snapshots.docs[0].data();

        if (taxData.tax_active) {
            $('#tax').val(taxData.tax_amount);
            $('#taxLabel').val(taxData.tax_lable);
            $('#taxType').val(taxData.tax_type);
        }

    });

    var AdminCommission = database.collection('settings').doc('AdminCommission');

    AdminCommission.get().then(async function (AdminCommissionSnapshots) {

        AdminCommissionRes = AdminCommissionSnapshots.data();

        if (AdminCommissionRes.isEnabled) {

            $("#adminCommission").val(AdminCommissionRes.fix_commission);
            $("#adminCommissionType").val(AdminCommissionRes.commissionType);

        }

    });


    var currencyData = '';
    var decimal_degits = 0;

    refCurrency.get().then(async function (snapshots) {
        currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });
    var address_lat = "";
    var address_lng = "";
    var drop_address_lat = "";
    var drop_address_lng = "";
    var count = 0;

    var isDriver = false;
    var driver_rate = 0;
    var car_rate = 0;

    var startDate = "";
    var endDate = "";

    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');

    var placeholderImage = '';

    placeholderImageRef.get().then(async function (placeholderImageSnapshots) {

        var placeHolderImageData = placeholderImageSnapshots.data();

        placeholderImage = placeHolderImageData.image;

    });

    $(document).ready(function () {


        var rentalCarsData = '<?php echo json_encode($rentalCarsData);?>';

        getRentalCarDetails(rentalCarsData);
        pickLocation();
        dropLocation();
    });


    var vehicleType = [];

    function getRentalCarDetails(rentalCarsData) {

        $("#data-table_processing_order").show();
        rentalCarsData = JSON.parse(rentalCarsData);

        startDate = rentalCarsData.startDate;
        endDate = rentalCarsData.endDate;

        if (rentalCarsData.isDriver == "true" || rentalCarsData.isDriver == true) {
            isDriver = true;
        } else {
            isDriver = false;
        }

        var rentalServiceRef = "";
        rentalServiceRef = geoFirestore.collection('users').where("role", "==", "driver").where('serviceType', '==', "rental-service").near({
            center: new firebase.firestore.GeoPoint(parseFloat(rentalCarsData.address_lat), parseFloat(rentalCarsData.address_lng)),
            radius: 100
        }).limit(200);

        address_lat = rentalCarsData.address_lat;
        address_lng = rentalCarsData.address_lng;
        console.log(address_lat);console.log(address_lng);
        drop_address_lat = rentalCarsData.drop_address_lat;
        drop_address_lng = rentalCarsData.drop_address_lng;

        rentalServiceRef.get().then(async function (snapShots) {

            if (snapShots.docs.length > 0) {

                var checkFlag = true;
                var count = 0;
                var userIds = [];
                  console.log(snapShots.docs.length);
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
                            userIds.push(data.id);
                            count++;
                        }

                    }
                });

                if (snapShots.docs.length > count) {
                    buildCarTypeHtml(snapShots, rentalCarsData.address_lat, rentalCarsData.address_lng, userIds);
                    $('.showCarDiv').show();
                    $('.noData').hide();
                } else {
                    $("#data-table_processing_order").hide();
                    $('.noData').show();
                    $('.showCarDiv').hide();
                }
            } else {
                $("#data-table_processing_order").hide();
                $('.noData').show();
                $('.showCarDiv').hide();
            }

            // if (snapShots.docs.length > 0) {
            //
            //     buildCarTypeHtml(snapShots, rentalCarsData.address_lat, rentalCarsData.address_lng);
            //     $('.showCarDiv').show();
            //     $('.noData').hide();
            // } else {
            //
            //     $("#data-table_processing_order").hide();
            //     $('.noData').show();
            //     $('.showCarDiv').hide();
            // }
        });

    }

    $(document).on('change', '.isDriver', function () {

        if ($(this).is(':checked') == true) {
            isDriver = true;
        } else {
            isDriver = false;
        }
    });

    function buildCarTypeHtml(snapShots, addressLat, addressLong, userIds) {


        var carTypeHtml = "";
        snapShots.docs.forEach((listval) => {

            var carType = listval.data();
            carType.id = listval.id;

            var userId = carType.id;


            if (carType.vehicleType) {
                if ($.inArray(carType.vehicleType, vehicleType) === -1) {
                    vehicleType.push(carType.vehicleType);
                }
            }

            if (userIds.length > 0) {
                userIds.forEach((userIdsData) => {
                    if (userIdsData == userId) {
                        vehicleType.splice($.inArray(carType.vehicleType, vehicleType), 1);

                    }
                });
            }

        });

        if (vehicleType.length > 0) {
            vehicleType.forEach((data) => {

                var rentalVehicleTypeRef = database.collection('rental_vehicle_type').where("name", "==", data);

                rentalVehicleTypeRef.get().then(async function (snapshots) {

                    snapshots.docs.forEach((section) => {
                        var datas = section.data();

                        var activeTag = "";
                        if (count == 0) {
                            activeTag = "active show";
                        }

                        carTypeHtml = '<a class="nav-link mb-4 ' + activeTag + '" id="v-pills-home-tab" data-toggle="pill"\n' +
                            '                                       href=".v-pills-home_' + datas.name + '" role="tab" aria-controls="v-pills-home"\n' +
                            '                                       aria-selected="true" value="' + datas.name + '" addressLat="' + addressLat + '" addressLong="' + addressLong + '" userIds = ' + JSON.stringify(userIds) + '>\n' +
                            '                                        <img alt="#"\n' +
                            '                                             src="' + datas.rental_vehicle_icon + '"\n' +
                            '                                             class="img-fluid item-img w-100">\n' +
                            '                                        <span class="font-weight-bold">' + datas.name + '</span></a>';

                        vehicleTypeHtml = '<div class="tab-pane fade ' + activeTag + ' v-pills-home_' + datas.name + '" role="tabpanel"\n' +
                            '                                 aria-labelledby="v-pills-home-tab"></div>';

                        $('.car_type_detail_div').append(vehicleTypeHtml);
                        buildCarTypeDetailsHtml(data, addressLat, addressLong, userIds);
                        count++;
                        $('.car_type_div').append(carTypeHtml);

                    });

                });


            });
        } else {
            $("#data-table_processing_order").hide();
        }

        return carTypeHtml;
    }

    $(document).on('click', '.nav-link', function () {

        var href = $(this).attr('href');
        var vehicleType = $(this).attr('value');
        var addressLat = $(this).attr('addressLat');
        var addressLong = $(this).attr('addressLong');
        var userIds = $(this).attr('userIds');

        $("#data-table_processing_order").show();

        $('.tab-pane').html('');
        buildCarTypeDetailsHtml(vehicleType, addressLat, addressLong, JSON.parse(userIds));
        $(href).show();

    });

    $(document).on('change', '.isDropSameLocation', function () {

        if ($(this).is(':checked') == true) {
            $('.dropOffDiv').hide();
        } else {
            $('.dropOffDiv').show();
        }
    });

    function findCar() {

        var isDriver = $('.isDriver').is(':checked');
        var startTime = $('.startTime').val();
        var endTime = $('.endTime').val();
        var pickLocation = $('.pickLocation').val();
        var isDropSameLocation = $('.isDropSameLocation').is(':checked');
        var dropLocation = $('.dropLocation').val();

        var startDate = $('.pick-up-date').val();
        var endDate = $('.drop-off-date').val();


        if (isDropSameLocation == true) {

            dropLocation = pickLocation;
            drop_address_lat = address_lat;
            drop_address_lng = address_lng;
        }

        var dt = new Date();
        var currentTime = dt.getHours() + ":" + dt.getMinutes();

        var currentDate = dt.getDate() + "/" + (dt.getMonth() + 1) + "/" + dt.getFullYear();

        $('.noData').html("");
        $('.noData').show();
        $('.car_type_div').html('');
        $('.car_type_detail_div').html('');
        $('.showCarDiv').hide();

        if (startTime == "" || endTime == "") {

            $('.noData').html("{{trans('lang.start_end_time_error')}}");
            window.scroll(0, 0);

        } else if (currentDate == startDate && currentDate == endDate && startTime < currentTime) {

            $('.noData').html("{{trans('lang.start_greater_time_error')}}");
            window.scroll(0, 0);

        } else if (startTime > endTime || endTime < startTime) {

            $('.noData').html("{{trans('lang.start_end_greater_time_error')}}");
            window.scroll(0, 0);

        } else if (pickLocation == "") {

            $('.noData').html("{{trans('lang.pickup_location_error')}}");
            window.scroll(0, 0);
        } else if (isDropSameLocation == true && dropLocation == "") {

            $('.noData').html("{{trans('lang.dropoff_location_error')}}");
            window.scroll(0, 0);

        } else {
            $("#data-table_processing_order").show();

            $('.noData').html("");

            var arrayDetails = [];

            var object = {
                "isDriver": isDriver,
                "startDate": startDate,
                "endDate": endDate,
                "startTime": startTime,
                "endTime": endTime,
                "pickLocation": pickLocation,
                "dropLocation": dropLocation,
                "isDropSameLocation": isDropSameLocation,
                "address_lat": address_lat,
                "address_lng": address_lng,
                "drop_address_lat": drop_address_lat,
                "drop_address_lng": drop_address_lng
            };

            arrayDetails.push(JSON.stringify(object));

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
                    car_rate: $('#carRate').val(),
                    driver_rate: $('#driverRate').val(),
                    tax: $('#tax').val(),
                    taxLabel: $('#taxLabel').val(),
                    taxType: $('#taxType').val(),
                    adminCommissionType: $('#adminCommissionType').val(),
                    adminCommission: $('#adminCommission').val(),
                    drop_address_lat: drop_address_lat,
                    drop_address_lng: drop_address_lng,
                    decimal_degits: decimal_degits,

                },

                success: function (data) {

                    data = JSON.parse(data);

                    $('.car_type_div').html('');
                    $('.car_type_detail_div').html('');
                    count = 0;
                    getRentalCarDetails(arrayDetails);

                }

            });

        }
    }

    function buildCarTypeDetailsHtml(vehicleType, addressLat, addressLong, userIds) {

        var vehicleTypeHtml = "";
        var rentalServiceRef = "";

        rentalServiceRef = geoFirestore.collection('users').where("role", "==", "driver").where('serviceType', '==', "rental-service").where("vehicleType", "==", vehicleType).near({
            center: new firebase.firestore.GeoPoint(parseFloat(addressLat), parseFloat(addressLong)),
            radius: 100
        });

        rentalServiceRef.get().then(async function (snapShots) {

            if (snapShots.docs.length > 0) {

                var usersData = [];
                snapShots.docs.forEach((section) => {
                    var datas = section.data();

                    usersData.push(datas.id);
                    if (userIds.length > 0) {
                        userIds.forEach((data) => {
                            if (data == datas.id) {
                                usersData.splice($.inArray(data, usersData), 1);

                            }

                        });
                    }
                });

                if (usersData.length > 0) {
                    usersData.forEach((datas) => {

                        var usersRef = database.collection('users').where("id", "==", datas).get();

                        usersRef.then(async function (snapShotData) {
                            if (snapShotData.docs.length > 0) {
                                snapShotData.docs.forEach((section) => {
                                    var datas = section.data();

                                    var rating = 0;
                                    if (datas.reviewsSum && datas.reviewsCount) {
                                        rating = (datas.reviewsSum / datas.reviewsCount);

                                        rating = Math.round(rating * 10) / 10;

                                    }

                                    var carRate = 0;
                                    if (datas.carRate) {
                                        carRate = datas.carRate;

                                    }

                                    if (isDriver && datas.driverRate) {
                                        carRate = parseInt(carRate) + parseInt(datas.driverRate);

                                    }

                                    if (currencyAtRight) {
                                        carRate = carRate + "" + currentCurrency;
                                    } else {
                                        carRate = currentCurrency + "" + carRate;
                                    }

                                    var passengers = 0;

                                    if (datas.carInfo.passenger && datas.carInfo.passenger != null && datas.carInfo.passenger != undefined) {
                                        passengers = datas.carInfo.passenger;
                                    }
                                    var gear = "";
                                    if (datas.carInfo.gear && datas.carInfo.gear != null) {
                                        gear = datas.carInfo.gear;
                                    }

                                    var fuel_type = "";
                                    if (datas.carInfo.fuel_type && datas.carInfo.fuel_type != null) {
                                        fuel_type = datas.carInfo.fuel_type;
                                    }

                                    var carMakes = "";
                                    if (datas.carMakes && datas.carMakes != undefined) {
                                        carMakes = datas.carMakes;
                                    }
                                    var car_image = placeholderImage;
                                    console.log(datas.carInfo.car_image)
                                    if (datas.carInfo.car_image && datas.carInfo.car_image != '' && datas.carInfo.car_image != null) {

                                        if (datas.carInfo.car_image.length > 0) {


                                            car_image = datas.carInfo.car_image[0];

                                        }
                                    }

                                    vehicleTypeHtml = '<a href="#" onclick=rentalCarsView("' + datas.id + '","' + datas.driverRate + '","' + datas.carRate + '") class="rentalCarsView"><div class="rentalcar-list bg-white p-3 mb-4">\n' +
                                        '                                    <div class="row">\n' +
                                        '                                        <div class="col-md-3 car-img align-items-center d-flex">\n' +
                                        '                                            <img alt="#"\n' +
                                        '                                                 src="' + car_image + '"\n' +
                                        '                                                 class="img-fluid item-img">\n' +
                                        '                                        </div>\n' +
                                        '                                        <div class="col-md-7 car-detail car-det-title">\n' +
                                        '                                            <h3>' + datas.carName + ' ' + carMakes + '</h3>\n' +
                                        '                                            <div class="ratings">\n' +
                                        '                                                <ul class="rating" data-rating="0" >\n' +
                                        '                                                    <li class="rating__item"></li>\n' +
                                        '                                                </ul>\n' +
                                        '                                                <span>' + rating + '</span>\n' +
                                        '                                            </div>\n' +
                                        '                                            <div class="car-feture">\n' +
                                        '                                                <ul>\n' +
                                        '                                                    <li><img src="../img/user-icon.png">' + passengers + ' Pessengers</li>\n' +
                                        '                                                    <li><img src="../img/manual-icon.png">' + gear + '</li>\n' +
                                        '                                                    <li><img src="../img/fuel-icon.png">' + fuel_type + '</li>\n' +
                                        '                                                </ul>\n' +
                                        '                                            </div>\n' +
                                        '                                        </div>\n' +
                                        '                                        <div class="col-md-2 car-price">\n' +
                                        '                                            <span class="price">' + carRate + '/<small>day</small></span>\n' +
                                        '                                        </div>\n' +
                                        '                                    </div>\n' +
                                        '                            </div></a>\n' +
                                        '                            ';
                                    $('.v-pills-home_' + vehicleType).append(vehicleTypeHtml);
                                    $('.v-pills-home_' + vehicleType).show();

                                });
                                $("#data-table_processing_order").hide();

                            } else {
                                $("#data-table_processing_order").hide();

                            }
                        });

                    });
                } else {
                    $("#data-table_processing_order").hide();

                }

            } else {
                $('.noData').show();
                $('.showCarDiv').hide();
                $("#data-table_processing_order").hide();
            }

        });

    }

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


    function rentalCarsView(id, driverRate, carRate) {

        var isDriver = $('.isDriver').is(':checked');
        var startTime = $('.startTime').val();
        var endTime = $('.endTime').val();
        var pickLocation = $('.pickLocation').val();
        var isDropSameLocation = $('.isDropSameLocation').is(':checked');
        var dropLocation = $('.dropLocation').val();


        if (isDropSameLocation == true) {

            dropLocation = pickLocation;
            drop_address_lat = address_lat;
            drop_address_lng = address_lng;
        }

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
                car_rate: carRate,
                driver_rate: driverRate,
                tax: $('#tax').val(),
                taxLabel: $('#taxLabel').val(),
                taxType: $('#taxType').val(),
                adminCommissionType: $('#adminCommissionType').val(),
                adminCommission: $('#adminCommission').val(),
                drop_address_lat: drop_address_lat,
                drop_address_lng: drop_address_lng,
                decimal_degits: decimal_degits,

            },

            success: function (data) {

                data = JSON.parse(data);

                var url = '{{route('rental_cars.view', ':id')}}';
                url = url.replace(':id', id);

                $('.rentalCarsView').attr('href', url);
                window.location.href = url;

            }

        });

    }
</script>

@include('layouts.nav')
