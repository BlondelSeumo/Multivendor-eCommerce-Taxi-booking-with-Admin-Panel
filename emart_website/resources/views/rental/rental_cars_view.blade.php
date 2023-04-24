@include('layouts.app')


@include('layouts.header')


<?php
session_start();

?>
<!-- /**********************************rental-car-detail***************************/ -->

<div class="rentalcar-detail-page pt-5" style="background: #F2F6F9 ;">


    <div class="container">
        <div class="car-detail-inner">
            <div class="car-del-top-section">
                <div class="row">
                    <div class="col-md-6 rent-cardet-left">
                        <div class="photo-gallary">

                            <div class="demo">

                                <ul id="lightSlider">

                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6 rent-cardet-right">
                        <div class="carrent-det-rg-inner" id="carDetailInfo">


                        </div>
                    </div>
                </div>

            </div>


            <!-- ************************car rental review************************ -->

            <div class="py-2 mb-3 rental-detailed-ratings-and-reviews mt-5">

                <div class="row">
                    <div class="col-md-6 rental-review">
                        <h3 class="w-100">Reviews</h3>
                        <div id="customers_ratings_and_review">

                        </div>

                        <div class="see_all_review_div" style="display:none">
                            <button class="btn btn-primary btn-block btn-sm see_all_reviews"> See All Reviews</button>
                        </div>
                        <p class="no_review_fount" style="display:none">No Review Found !</p>

                    </div>
                </div>

            </div>


            <!-- ************************car rental review************************ -->

        </div>
    </div>

</div>
</div>


<!-- /**********************************rental-car-detail***************************/ -->


<div id="data-table_processing_order" class="dataTables_processing panel panel-default" style="display: none;">
    {{trans('lang.processing')}}
</div>

@include('layouts.footer')


@include('layouts.nav')

<!-- GeoFirestore -->

<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>

<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>

<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>

<link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
<script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>

<script type="text/javascript">


    var rental_user_id = "<?php echo $id; ?>";
    console.log(rental_user_id);
    var user_id = "<?php echo $user_id; ?>";
    var id_order = "<?php echo uniqid();?>";
    var fcmToken = '';
    var currentCurrency = '';
    var currencyAtRight = false;
    var wallet_amount = 0;
    var database = firebase.firestore();
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    var currencyData = "";
    refCurrency.get().then(async function (snapshots) {
        currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
        loadcurrency();
    });

    var review_pagesize = 4;
    var review_start = null;

    var ratings = database.collection('items_review').where('driverId', "==", rental_user_id);

    var rentalVehicleTypeUserRef = database.collection('users').where('id', "==", rental_user_id);

    var UserRef = database.collection('users').where('id', "==", user_id);

    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');

    var placeholderImage = '';

    placeholderImageRef.get().then(async function (placeholderImageSnapshots) {

        var placeHolderImageData = placeholderImageSnapshots.data();

        placeholderImage = placeHolderImageData.image;

    });

    function loadcurrency() {
        if (currencyAtRight) {
            jQuery('.currency-symbol-left').hide();
            jQuery('.currency-symbol-right').show();
            jQuery('.currency-symbol-right').text(currentCurrency);
            $('#wallet_box').text('Wallet ( You have ' + currentCurrency + '0 )');
        } else {
            jQuery('.currency-symbol-left').show();
            jQuery('.currency-symbol-right').hide();
            jQuery('.currency-symbol-left').text(currentCurrency);
            $('#wallet_box').text('Wallet ( You have 0' + currentCurrency + ' )');
        }


    }


    var isDriver = false;
    var rentalCarRate = 0;
    var rentalDriverRate = 0;

    $(document).ready(function () {


        var rentalCarsData = '<?php echo json_encode($rentalCarsData);?>';

        getRentalVehicleTypeDetails(rentalCarsData).then(function (response) {

            getUsersReviews(true);

            $('#lightSlider').lightSlider({
                'gallery': true,
                'item': 1,
                'loop': true,
                'slideMargin': 0,
                'thumbItem': 6,
            });
        });

    });

    function getUsersReviews(limit) {

        customerRatingsAndReviews = document.getElementById('customers_ratings_and_review');


        if (limit && review_pagesize) {

            var reviewHTML = '';

            ratings.limit(review_pagesize).get().then(async function (snapshots) {

                review_start = snapshots.docs[snapshots.docs.length - 1];
                if (snapshots.docs.length > 3) {
                    $(".see_all_review_div").show();
                }
                if (snapshots.docs.length == 0) {
                    $(".no_review_fount").show();
                }

                reviewHTML = buildRatingsAndReviewsHTML(snapshots);

                if (reviewHTML != '') {

                    jQuery("#customers_ratings_and_review").append(reviewHTML);

                }

            });

        } else if (review_start) {


            ratings.startAfter(review_start).limit(review_pagesize).get().then(async function (snapshots) {

                review_start = snapshots.docs[snapshots.docs.length - 1];
                reviewHTML = buildRatingsAndReviewsHTML(snapshots);

                if (reviewHTML != '') {

                    jQuery("#customers_ratings_and_review").append(reviewHTML);


                }

            });

        }

    }

    $(".see_all_reviews").click(function () {


        getUsersReviews(false);

    });

    function buildRatingsAndReviewsHTML(reviewsSnapshots) {

        var reviewhtml = '';

        var allreviewdata = [];

        reviewsSnapshots.docs.forEach((listval) => {

            var reviewDatas = listval.data();
            reviewDatas.id = listval.id;
            allreviewdata.push(reviewDatas);

        });


        allreviewdata.forEach((listval) => {

            var val = listval;
            var rating = val.rating;

            reviewhtml = reviewhtml + '<div class="reviews-members py-3 border-bottom mb-3"><div class="media">';
           
            //if (val.profile == '' || val.profile.indexOf('firebasestorage.googleapis.com') == -1) {
                const rating_details = rating_data(val.CustomerId);
                reviewhtml = reviewhtml + '<a href="javascript:void(0);" class="image"><img alt="#" src="" class="mr-3 rounded-pill image'+val.CustomerId+'"></a>';
            //}
            // } else {
            //     try {
            //         const rating_details = rating_data(val.CustomerId);
            //         reviewhtml = reviewhtml + '<a href="javascript:void(0);" ><img alt="#" src="" class="mr-3 rounded-pill image'+val.CustomerId+'"></a>';
            //     } catch (err) {
            //         reviewhtml = reviewhtml + '<a href="javascript:void(0);"><img alt="#" src="' + placeholderImage + '" class="mr-3 rounded-pill"></a>';
            //     }

            // }
            
            reviewhtml = reviewhtml + '<div class="media-body d-flex"><div class="reviews-members-header"><h6 class="mb-0"><a class="text-dark name'+val.CustomerId+'" href="javascript:void(0);"></a></h6>' +
                '<div class="star-rating"><div class="d-inline-block" style="font-size: 14px;">';

                // if (rating > 1) {

                // reviewhtml = reviewhtml + '<i class="feather-star text-warning"></i>';

                // } else {

                // reviewhtml = reviewhtml + '<i class="feather-star"></i>';

                // }

                // if (rating > 2 || rating > 1.5) {

                // reviewhtml = reviewhtml + '<i class="feather-star text-warning"></i>';
                // }
                // else {

                // reviewhtml = reviewhtml + '<i class="feather-star"></i>';

                // }

                // if (rating > 3 || rating > 2.5) {

                // reviewhtml = reviewhtml + '<i class="feather-star text-warning"></i>';

                // } else {

                // reviewhtml = reviewhtml + '<i class="feather-star"></i>';

                // }

                // if (rating > 4 || rating > 3.5) {

                // reviewhtml = reviewhtml + '<i class="feather-star text-warning"></i>';

                // } else {

                // reviewhtml = reviewhtml + '<i class="feather-star"></i>';

                // }

                // if (rating > 5 || rating > 4.5) {

                // reviewhtml = reviewhtml + '<i class="feather-star text-warning"></i>';

                // } else {

                // reviewhtml = reviewhtml + '<i class="feather-star"></i>';

                // }
                reviewhtml=reviewhtml + '<ul class="rating" style="color: #ffc107 !important;" data-rating="'+val.rating+'"><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li><li class="rating__item"></li></ul>';

            reviewhtml = reviewhtml + '</div></div>';

            reviewhtml = reviewhtml + '</div>' +
                '<div class="review-date ml-auto">\n';

            var reviewDate = "";

            if (val.date) {
                reviewDate = val.date;
            }
            reviewhtml = reviewhtml + '<span>' + reviewDate + '</span>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>';

            reviewhtml = reviewhtml + '<div class="reviews-members-body w-100"><p>' + val.comment + '</p></div></div>';

        });

        return reviewhtml;

    }
    async function rating_data(rating_details) {
        var ratings_get = '';
        await database.collection('users').where("id", "==", rating_details).get().then(async function (snapshotss) {
       
            if (snapshotss.docs[0]) {
                var rating_data = snapshotss.docs[0].data();
                   var name = rating_data.firstName + " " + rating_data.lastName;
                   console.log(rating_data);
                   var image = rating_data.profilePictureURL;
                if(rating_data.profilePictureURL != "") {
                    jQuery(".image" + rating_details).attr('src',image);
                }
                else{
                    jQuery(".image" + rating_details).attr('src',placeholderImage);

                }
                jQuery(".name" + rating_details).html(name);
            } else {
                jQuery(".name" + rating_details).html('');
            }
        });
        return ratings_get;
    }


    function bindCarImages(arrayCarImages = "") {
        var carImagesHtml = '';

        if (arrayCarImages != "") {
            if (arrayCarImages.length > 0) {
                for (var i = 0; i < arrayCarImages.length; i++) {
                    carImagesHtml = '<li data-thumb="' + arrayCarImages[i] + '" class="lslide">' +
                        '                                        <img src="' + arrayCarImages[i] + '"/>' +
                        '                                    </li>';

                    $('#lightSlider').append(carImagesHtml);

                }
            } else {
                $('#lightSlider').append('<li data-thumb="' + placeholderImage + '" class="lslide">\n' +
                    '                                        <img src="' + placeholderImage + '"/>\n' +
                    '                                    </li>');
            }
        } else {
            $('#lightSlider').append('<li data-thumb="' + placeholderImage + '" class="lslide">\n' +
                '                                        <img src="' + placeholderImage + '"/>\n' +
                '                                    </li>');
        }


    }

    async function getRentalVehicleTypeDetails(rentalCarsData) {

        $("#data-table_processing_order").show();
        rentalCarsData = JSON.parse(rentalCarsData);

        if (rentalCarsData.isDriver == "true") {
            isDriver = true;

        }

        var ref = rentalVehicleTypeUserRef.get().then(async function (snapshots) {

            var rentalVehicleTypeDetails = snapshots.docs[0].data();

            var userWalletAmount = 0;
            if (rentalVehicleTypeDetails.wallet_amount != undefined && rentalVehicleTypeDetails.wallet_amount != '') {

                wallet_amount = rentalVehicleTypeDetails.wallet_amount.toFixed(2);
                userWalletAmount = rentalVehicleTypeDetails.wallet_amount.toFixed(2);

            }

            $("#user_wallet_amount").val(userWalletAmount);

            if (currencyAtRight) {
                userWalletAmount = userWalletAmount + "" + currentCurrency;

            } else {
                userWalletAmount = currentCurrency + "" + userWalletAmount;
            }

            $('#wallet_box').text('Wallet ( You have ' + userWalletAmount + ')');

            $("#wallet_amount").html(userWalletAmount);


            if (rentalVehicleTypeDetails.hasOwnProperty('carInfo')) {
                var carInfo = rentalVehicleTypeDetails.carInfo;
                if (carInfo.hasOwnProperty('car_image') && carInfo.car_image != '' && carInfo.car_image != null) {
                    bindCarImages(carInfo.car_image);
                } else {

                    bindCarImages();
                }

            } else {
                bindCarImages();
            }

            var rating = 0;
            if (rentalVehicleTypeDetails.hasOwnProperty('reviewsCount') && rentalVehicleTypeDetails.hasOwnProperty('reviewsSum')) {
                if (rentalVehicleTypeDetails.reviewsSum > 0 && rentalVehicleTypeDetails.reviewsCount > 0) {
                    rating = (rentalVehicleTypeDetails.reviewsSum / rentalVehicleTypeDetails.reviewsCount);

                    rating = Math.round(rating * 10) / 10;
                }

            } else {
                rating = 0;
            }

            var carRate = 0;
            if (rentalVehicleTypeDetails.hasOwnProperty('carRate')) {
                carRate = rentalVehicleTypeDetails.carRate;
                rentalCarRate = carRate;
            }

            if (isDriver && rentalVehicleTypeDetails.driverRate) {
                carRate = parseInt(carRate) + parseInt(rentalVehicleTypeDetails.driverRate);
                rentalDriverRate = rentalVehicleTypeDetails.driverRate;
            }

            if (currencyAtRight) {
                carRate = carRate + "" + currentCurrency;
            } else {
                carRate = currentCurrency + "" + carRate;
            }

            var maxPower = mph = topSpeed = passenger = doors = air_conditioning = gear = mileage = fuel_filling = fuel_type = "";

            if (rentalVehicleTypeDetails.hasOwnProperty('carInfo')) {

                if (rentalVehicleTypeDetails.carInfo.maxPower && rentalVehicleTypeDetails.carInfo.maxPower != null && rentalVehicleTypeDetails.carInfo.maxPower != "") {
                    maxPower = rentalVehicleTypeDetails.carInfo.maxPower;

                }

                if (rentalVehicleTypeDetails.carInfo.mph && rentalVehicleTypeDetails.carInfo.mph != null && rentalVehicleTypeDetails.carInfo.mph != "") {
                    mph = rentalVehicleTypeDetails.carInfo.mph;
                }

                if (rentalVehicleTypeDetails.carInfo.topSpeed && rentalVehicleTypeDetails.carInfo.topSpeed != null && rentalVehicleTypeDetails.carInfo.topSpeed != "") {
                    topSpeed = rentalVehicleTypeDetails.carInfo.topSpeed;
                }

                if (rentalVehicleTypeDetails.carInfo.passenger && rentalVehicleTypeDetails.carInfo.passenger != null && rentalVehicleTypeDetails.carInfo.passenger != "") {
                    passenger = rentalVehicleTypeDetails.carInfo.passenger;
                }

                if (rentalVehicleTypeDetails.carInfo.doors && rentalVehicleTypeDetails.carInfo.doors != null && rentalVehicleTypeDetails.carInfo.doors != "") {
                    doors = rentalVehicleTypeDetails.carInfo.doors;
                }

                if (rentalVehicleTypeDetails.carInfo.gear && rentalVehicleTypeDetails.carInfo.gear != null && rentalVehicleTypeDetails.carInfo.gear != "") {
                    gear = rentalVehicleTypeDetails.carInfo.gear;
                }

                if (rentalVehicleTypeDetails.carInfo.mileage && rentalVehicleTypeDetails.carInfo.mileage != null && rentalVehicleTypeDetails.carInfo.mileage != "") {
                    mileage = rentalVehicleTypeDetails.carInfo.mileage;
                }


                if (rentalVehicleTypeDetails.carInfo.fuel_filling && rentalVehicleTypeDetails.carInfo.fuel_filling != null && rentalVehicleTypeDetails.carInfo.fuel_filling != "") {
                    fuel_filling = rentalVehicleTypeDetails.carInfo.fuel_filling;
                }
                if (rentalVehicleTypeDetails.carInfo.fuel_type && rentalVehicleTypeDetails.carInfo.fuel_type != null && rentalVehicleTypeDetails.carInfo.fuel_type != "") {
                    fuel_type = rentalVehicleTypeDetails.carInfo.fuel_type;
                }


                if (rentalVehicleTypeDetails.carInfo.air_conditioning == "Yes") {
                    air_conditioning = rentalVehicleTypeDetails.carInfo.air_conditioning;
                }
            }


            var carMakes = "";
            if (rentalVehicleTypeDetails.carMakes && rentalVehicleTypeDetails.carMakes != undefined) {
                carMakes = rentalVehicleTypeDetails.carMakes;
            }

            var carDetailHtml = '       <div class="car-det-head mb-3">\n' +
                '                                <div class="d-flex">\n' +
                '                                    <div class="car-det-title">\n' +
                '                                        <h2>' + rentalVehicleTypeDetails.carName + ' ' + carMakes + '</h2>\n' +
                '                                        <div class="ratings">\n' +
                '                                            <ul class="rating" data-rating="0">\n' +
                '                                                <li class="rating__item"></li>\n' +
                '                                            </ul>\n' +
                '                                            <span>' + rating + '</span>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="car-det-price ml-auto">\n' +
                '                                        <span class="price">' + carRate + '/<small>day</small></span>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </div>' +
                '<div class="car-specs-det mt-2 mb-3">\n' +
                '                                <h3>Car Specs</h3>\n' +
                '                                <div class="row">\n' +
                '                                    <div class="col-md-4 car-specs-box">\n' +
                '                                        <div class="car-specs-box-inner">\n' +
                '                                            <label>Max Power</label>\n' +
                '                                            <span>' + maxPower +' hp'+ '</span>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-4 car-specs-box">\n' +
                '                                        <div class="car-specs-box-inner">\n' +
                '                                            <label>0-60 mph</label>\n' +
                '                                            <span>' + mph +' sec' +'</span>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-4 car-specs-box">\n' +
                '                                        <div class="car-specs-box-inner">\n' +
                '                                            <label>Top Speed</label>\n' +
                '                                            <span>' + topSpeed +' mph'+ '</span>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                            </div>\n' +
                ' <div class="car-info-det mt-3 mb-3">\n' +
                '                                <h3>Car Info</h3>\n' +
                '                                <div class="row">\n' +
                '                                    <div class="col-md-6 car-info-box">\n' +
                '                                        <div class="car-info-box-list d-flex align-items-center">\n' +
                '                                            <span><img src="../img/user-icon.png"></span><label>' + passenger + ' Pessengers</label>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-6 car-info-box">\n' +
                '                                        <div class="car-info-box-list d-flex align-items-center">\n' +
                '                                            <span><img src="../img/door-icon.png"></span><label>' + doors + ' Doors</label>\n' +
                '                                        </div>\n' +
                '                                    </div>\n';
            if (air_conditioning) {
                carDetailHtml += '                 <div class="col-md-6 car-info-box">\n' +
                    '                                        <div class="car-info-box-list d-flex align-items-center">\n' +
                    '                                            <span><img src="../img/ac-icon.png"></span><label>Air Conditioning</label>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n';
            }

            carDetailHtml += '                        <div class="col-md-6 car-info-box">\n' +
                '                                        <div class="car-info-box-list d-flex align-items-center">\n' +
                '                                            <span><img src="../img/manual-icon.png"></span><label>' + gear + '</label>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-6 car-info-box">\n' +
                '                                        <div class="car-info-box-list d-flex align-items-center">\n' +
                '                                            <span><img src="../img/mlg-icon.png"></span><label>' + mileage + ' Mileage</label>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-6 car-info-box">\n' +
                '                                        <div class="car-info-box-list d-flex align-items-center">\n' +
                '                                            <span><img src="../img/fuel-icon.png"></span><label>Fuel ' + fuel_filling + '\n' +
                '                                                </label>\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="col-md-6 car-info-box">\n' +
                '                                        <div class="car-info-box-list d-flex align-items-center">\n' +
                '                                            <span><img src="../img/fuel-icon.png"></span><label>' + fuel_type + '</label>\n' +
                '                                        </div>\n' +
                '                                    </div>\n';

            if (rentalVehicleTypeDetails.hasOwnProperty('carNumber')) {

                carDetailHtml += '                                    <div class="col-md-6 car-info-box">\n' +
                    '                                        <div class="car-info-box-list d-flex align-items-center">\n' +
                    '                                            <span><img src="../img/user-icon.png"></span><label>' + rentalVehicleTypeDetails.carNumber + '</label>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n';
            }


            carDetailHtml += '                                </div>\n' +
                '                            </div>';


            if (rentalVehicleTypeDetails.hasOwnProperty('companyId') && rentalVehicleTypeDetails.companyId != "") {

                var companyDetailsRef = database.collection('users').where('id', "==", rentalVehicleTypeDetails.companyId);

                companyData = companyDetailsRef.get().then(async function (companySnapshots) {

                    if (companySnapshots.docs.length == 0) {

                        return;

                    }

                    return companySnapshots.docs[0].data();

                });

                company = await companyData.then(function (response) {

                    return response;
                });


                carDetailHtml += ' <div class="car-renter mt-3">\n' +
                    '                                <h3>Renter</h3>\n' +
                    '                                <div class="car-renter-box">\n' +
                    '                                    <div class="media align-items-center">\n' +
                    '                                        <img alt="#" src="' + company.profilePictureURL + '" class="mr-3 rounded-pill" style="height: 100px;width:100px;">\n' +
                    '                                        <div class="media-body">\n' +
                    '                                            <div class="renter-header">\n' +
                    '                                                <h6 class="mb-0">' + company.companyName + '</h6>\n' +
                    '                                                <div class="renter-locat">\n' +
                    '                                                    <span class="fa fa-map-marker mr-2"></span>' + company.companyAddress + '\n' +
                    '                                                </div>\n' +
                    '                                            </div>\n' +
                    '                                        </div>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    '                            </div>';
            }

            var url = '{{route('rental_cars_checkout', ':id')}}';
            url = url.replace(':id', rentalVehicleTypeDetails.id);

            carDetailHtml += '<div class="carrent-book mt-3">\n' +
                '                                <a href="' + url + '" class="btn book-btn">Book Car</a>\n' +
                '                            </div>';


            $('#carDetailInfo').append(carDetailHtml);
            $("#data-table_processing_order").hide();


            return true;
        });

        var refResponse = await ref.then(function (response) {

            return response;
        });

        return refResponse;

    }


</script>
