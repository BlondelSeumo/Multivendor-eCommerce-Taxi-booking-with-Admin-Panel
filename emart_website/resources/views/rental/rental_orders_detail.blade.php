@include('layouts.app')


@include('layouts.header')


<div class="d-none">

    <div class="bg-primary border-bottom p-3 d-flex align-items-center">

        <a class="toggle togglew toggle-2" href="#"><span></span></a>

        <h4 class="font-weight-bold m-0 text-white">{{trans('lang.my_orders')}}</h4>

    </div>

</div>

<section class="py-4 siddhi-main-body" style="background: #f2f6f9;">
    <input type="hidden" name="deliveryChargeMain" id="deliveryChargeMain">
    <input type="hidden" name="specialDiscountMain" id="specialDiscountMain">
    <input type="hidden" name="tax_active" id="tax_active">
    <input type="hidden" name="tax_label" id="tax_label">
    <input type="hidden" name="tax_amount" id="tax_amount">
    <input type="hidden" name="tax_type" id="tax_type">

    <div class="container">

        <div class="row">

            <div class="tab-content col-md-12" id="myTabContent">
                <div class="row">
                    <div class="col-md-9">
                        <div class="tab-pane fade show active" id="completed" role="tabpanel"
                             aria-labelledby="completed-tab">

                            <div class="order-body">
                                <div class="rentalcar-list bg-white p-3 mb-4">
                                    <div class="row">
                                        <div class="col-md-2 car-img align-items-center d-flex car_image">
                                        </div>
                                        <div class="col-md-8 car-detail car-det-title">
                                            <h3 class="car_name"></h3>
                                            <div class="ratings">
                                                <ul class="rating" data-rating="0">
                                                    <li class="rating__item"></li>
                                                </ul>
                                                <span class="rating_car"></span>
                                            </div>
                                            <div class="car-feture">
                                                <ul>
                                                    <li><img src="../img/user-icon.png">
                                                        <span class="pessengers_no"></span> {{trans("lang.pessengers")}}
                                                    </li>
                                                    <li><img src="../img/manual-icon.png"><span class="gear_"></span>
                                                    </li>
                                                    <li><img src="../img/fuel-icon.png"><span class="fuel_"></span></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 add-review-div "><a class="btn btn-primary add-review"
                                                                                     href="javascript:0" data-cid=""
                                                                                     data-did="" data-img="">Add
                                                    Review</a></div>
                                        </div>
                                        <div class="col-md-2 car-price">
                            <span class="price"><small></small>
                        <span class="car-price-with">{{trans("lang.With_driver_trip")}}</span>
                                        </div>
                                        <!-- </div> -->
                                        <br>
                                        <div class="order-rental-list-right">
                                            <div class=" carbook-summary ">
                                                <div class="row">
                                                    <div class="carbook-summary-box mb-4 col-md-5">
                                                        <h3>{{trans("lang.pick_up")}}</h3>
                                                        <p><img src="../img/time-icon.png">
                                                            <span class="pickup"></span></p>
                                                        <p><img src="../img/bk-location-icon.png">
                                                            <span class="pickup_address"></span>
                                                        </p>
                                                    </div>
                                                    <div class="carbook-summary-box mb-4 col-md-5">
                                                        <h3>{{trans("lang.drop_off")}}</h3>
                                                        <p><img src="../img/time-icon.png">
                                                            <span class="dropoff"></span></p>
                                                        <p><img src="../img/bk-location-icon.png">
                                                            <span class="dropoff_address"></span>
                                                        </p>
                                                    </div>
                                                    <div class="carbook-summary-box mb-4 col-md-2">
                                                        <h3>{{trans("lang.payment")}}</h3>
                                                        <p><img src="../img/done-icon.png">
                                                            <span class="payment_"></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-12"></div>
                                        <div class="col-md-1 align-items-right d-flex driver_image"
                                             style="padding-top: 20px !important;">
                                        </div>
                                        <div class="col-md-4 driver-detail" style="padding-top: 20px !important;">
                                            <span>Driver Info</span>
                                            <h5 class="driver_name"></h5>

                                        </div>

                                        <div class="col-md-7 align-items-center d-flex review">
                                            <!-- <button type="button" class="btn btn-primary review_add">Add Review</button> -->
                                        </div>
                                        <hr class="visible-or" style="width:100%;text-align:left;margin-left:0">
                                        <div class="col-md-1 align-items-center d-flex customer_image"
                                             style="padding-top: 20px !important;">
                                        </div>
                                        <div class="col-md-4 cars-detail" style="padding-top: 20px !important;">
                                            <span>Rental Info</span>
                                            <h5 class="customer_name"></h5>

                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                    </div>

                    <!--  </div> -->
                    <div class="col-md-3">

                        <div class="bg-white p-3 clearfix carbook-rg-summary-box">
                            <h5>{{trans("lang.order_summary")}}</h5>
                            <p class="btm-total mt-4"></p>
                            <p class="mb-2">{{trans("lang.sub_total")}} <span class="float-right text-dark"><span
                                            class="currency-symbol-left subtotal_"></span><span
                                            class="currency-symbol-right" style="display: none;"></span></span>
                            </p>
                            <hr>
                            <p class="mb-2">
                                <label> {{trans("lang.discount")}}  </label>
                                <span class="float-right text-dark">- <span
                                            class="currency-symbol-left discount_"></span><span
                                            class="currency-symbol-right" style="display: none;"></span></span>
                            </p>
                            <hr>
                            <p class="mb-2">
                                {{trans("lang.driver_amount")}}<span class="float-right text-dark"><span
                                            class="currency-symbol-left driver_amount_"></span><span
                                            class="currency-symbol-right" style="display: none;"></span></span>
                            </p>
                            <hr>

                            <p class="mb-2">
                                {{trans("lang.tax")}} <span class="float-right text-dark">+ <span
                                            class="currency-symbol-left tax_"></span><span class="currency-symbol-right"
                                                                                           style="display: none;"></span></span>
                            </p>
                            <hr>
                            <h6 class="font-weight-bold mb-0">{{trans("lang.total")}}<p
                                        class="float-right text-total-price"><span
                                            class="currency-symbol-left Total_"></span><span></span><span
                                            class="currency-symbol-right" style="display: none;"></span></p></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Add Review -->
    <span style="display: none;">
	<button type="button" class="btn btn-primary" id="" data-toggle="modal"
            data-target="#">Large modal</button>
	</span>
    <div class="modal fade" id="review-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered notification-main" role="document">
            <div class="modal-content">
                <div class="modal-header" style="display:block">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Review Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="modal-body-inner">
                        <h5 class="text-center">How is your Trip?</h5>
                        <p class="text-center">Your feedback will help us make rental services experience better.</p>
                        <div class="review-box">
                            <div class="form-group row" id="default_review">

                                <div class="col-sm-12">
                                    <div class="rating-wrap d-flex align-items-center mt-4 mb-3" id="#">
                                        <fieldset class="rating rate_this">
                                            <input type="radio" name="rating" id="star5" value="5"/><label for="star5"
                                                                                                           class="full"></label>
                                            <input type="radio" name="rating" id="star4.5" value="4.5"/><label
                                                    for="star4.5" class="half"></label>
                                            <input type="radio" name="rating" id="star4" value="4"/><label for="star4"
                                                                                                           class="full"></label>
                                            <input type="radio" name="rating" id="star3.5" value="3.5"/><label
                                                    for="star3.5" class="half"></label>
                                            <input type="radio" name="rating" id="star3" value="3"/><label for="star3"
                                                                                                           class="full"></label>
                                            <input type="radio" name="rating" id="star2.5" value="2.5"/><label
                                                    for="star2.5" class="half"></label>
                                            <input type="radio" name="rating" id="star2" value="2"/><label for="star2"
                                                                                                           class="full"></label>
                                            <input type="radio" name="rating" id="star1.5" value="1.5"/><label
                                                    for="star1.5" class="half"></label>
                                            <input type="radio" name="rating" id="star1" value="1"/><label for="star1"
                                                                                                           class="full"></label>
                                            <input type="radio" name="rating" id="star0.5" value="0.5"/><label
                                                    for="star0.5" class="half"></label>
                                            <input type="hidden" value="0" id="rating-value"/>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row text-center">
                                <div class="col-sm-12">
                                    <textarea class="form-control review_comment" id="review_comment"
                                              name="review_comment" placeholder="Type Comment..." value=""></textarea>
                                </div>
                            </div>
                            <!-- </div>
                            <div class="modal-footer"> -->
                            <div class="review-sub-btn">
                                <button type="button" class="btn btn-primary add_review_btn text-center"
                                        data-parent="modal-body">{{trans('lang.add_review')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add review -->

</section>


@include('layouts.footer')


@include('layouts.nav')

<script type="text/javascript">

    console.log(user_uuid);

    var append_categories = '';
    var id = "<?php echo $id;?>";
    var completedorsersref = database.collection('rental_orders').where("id", "==", id);
    ;

    var deliveryCharge = 0;
    var taxSetting = [];
    var placeholderImage = '';
    var rental_orders = database.collection('rental_orders');

    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;

    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    $(document).ready(function () {
        $('.add-review-div').hide();
//    getOrders();
        completedorsersref.get().then(async function (completedorderSnapshots) {
            var order = completedorderSnapshots.docs[0].data();

            if (order.status == 'Order Completed') {
                $('.add-review-div').show();
            }
            $('.add-review').attr('data-cid', order.authorID);
            $('.add-review').attr('data-did', order.driverID);
            $('.add-review').attr('data-img', order.author.profilePictureURL);
            $('.add-review').attr('data-rid', order.id);
            $('.add-review').attr('data-uname', order.author.firstName);

            var orderRestaurantImage = '';
            if (order.driver.carInfo.car_image.length > 0) {
                orderRestaurantImage = order.driver.carInfo.car_image[0];
            } else {

                orderRestaurantImage = placeholderImage;
            }


            if (orderRestaurantImage != '') {
                $(".car_image").append('<img class="img-fluid item-img" src="' + orderRestaurantImage + '" alt="image">');

            }
            $('.car_name').html(order.driver.carName + ' ' + order.driver.carMakes)

            var passengers = 0;
            if (order.driver.carInfo.passenger && order.driver.carInfo.passenger != null) {
                passengers = order.driver.carInfo.passenger;
            }
            $('.pessengers_no').html(passengers)
            var fuel_type = "";
            if (order.driver.carInfo.fuel_type && order.driver.carInfo.fuel_type != null) {
                fuel_type = order.driver.carInfo.fuel_type;
            }
            $('.fuel_').html(fuel_type)
            var gear = "";
            if (order.driver.carInfo.gear && order.driver.carInfo.gear != null) {
                gear = order.driver.carInfo.gear;
            }
            $('.gear_').html(gear)
            var order_discount = 0;

            if (order.hasOwnProperty('discount') && order.discount) {
                if (order.discount) {
                    order_discount = parseFloat(order.discount);
                }
            }

            var order_subtotal = parseFloat(order.subTotal);
            var order_total = 0;

            order_total = (parseFloat(order_subtotal) - parseFloat(order_discount));


            if (order.hasOwnProperty('driverRate') && order.driverRate) {
                order_total = (parseFloat(order_total) + parseFloat(order.driverRate));
            }
            tax = 0;
            if (order.hasOwnProperty('taxType')) {
                if (order.taxType && order.tax) {
                    if (order.taxType == "percent") {
                        tax = (order.tax * order_total) / 100;
                    } else {
                        tax = order.tax;
                    }
                }
            }

            order_total = order_total + parseFloat(tax);


            var driver_rate = parseFloat(order.driverRate)
            var subtotal = '';
            var taxes = '';
            var driver_amount = '';
            var discount = 0;
            if (currencyAtRight) {
                order_total_val = order_total.toFixed(decimal_degits) + '' + currentCurrency;
                subtotal = order_subtotal.toFixed(decimal_degits) + '' + currentCurrency;
                taxes = tax.toFixed(decimal_degits) + '' + currentCurrency;
                driver_amount = driver_rate.toFixed(decimal_degits) + '' + currentCurrency;
                discount = order_discount.toFixed(decimal_degits) + '' + currentCurrency;
            } else {
                order_total_val = currentCurrency + '' + order_total.toFixed(decimal_degits);
                subtotal = currentCurrency + '' + order_subtotal.toFixed(decimal_degits);
                taxes = currentCurrency + '' + tax.toFixed(decimal_degits);
                driver_amount = currentCurrency + '' + driver_rate.toFixed(decimal_degits);
                discount = currentCurrency + '' + order_discount.toFixed(decimal_degits);

            }
            $('.price').html(order_total_val);
            $('.subtotal_').html(subtotal);
            $('.driver_amount_').html(driver_amount);
            $('.discount_').html(discount);
            $('.tax_').html(taxes);
            $('.Total_').html(order_total_val);

            if (order.pickupDateTime._seconds != undefined) {
                var date = new Date(order.pickupDateTime._seconds * 1000);
                var pick_up_time = date.toLocaleTimeString('en-US');

            } else {
                var pick_up_time = order.pickupDateTime.toDate().toLocaleTimeString('en-US');

            }

            if (order.dropDateTime._seconds != undefined) {
                var date_drop = new Date(order.dropDateTime._seconds * 1000);
                var drop_off_time = date_drop.toLocaleTimeString('en-US');

            } else {
                var drop_off_time = order.dropDateTime.toDate().toLocaleTimeString('en-US');

            }
            $('.pickup').html(order.pickupDateTime.toDate().toDateString() + ' ' + pick_up_time)
            $('.pickup_address').html(order.pickupAddress);
            $('.dropoff').html(order.dropDateTime.toDate().toDateString() + ' ' + drop_off_time)
            $('.dropoff_address').html(order.dropAddress);
            payment = 'Done';
            $('.payment_').html(payment);

            if (order.driver.profilePictureURL != '') {
                $(".driver_image").append('<img class="rounded" style="width:50px" src="' + order.driver.profilePictureURL + '" alt="image">');

            } else {
                $(".driver_image").append('<img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">');

            }

            $('.driver_name').html(order.driver.firstName);
            console.log(order.driver.companyId)
            if (order.hasOwnProperty('company') && order.company.length > 0) {
                $('.cars-detail').show();
                $('.customer_image').show();
                if (order.company.profilePictureURL != '') {

                    $(".customer_image").append('<img class="rounded" style="width:50px" src="' + order.company.profilePictureURL + '" alt="image">');

                } else {
                    $(".customer_image").append('<img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">');

                }
                if (order.company.companyName != '') {

                    $('.customer_name').html(order.company.companyName)

                } else {
                    $('.customer_name').html('')

                }
            } else {
                $('.visible-or').css({'display': 'none'});
                $('.cars-detail').hide();
                $('.customer_image').hide();
            }

            var driverRatings = database.collection('users').where("id", "==", order.driverID);
            ;
            driverRatings.get().then(async function (ratingsSnapshots) {
                var ratings = ratingsSnapshots.docs[0].data();

                var rating = 0;
                if (ratings.reviewsSum && ratings.reviewsCount) {
                    rating = (ratings.reviewsSum / ratings.reviewsCount);

                    rating = Math.round(rating * 10) / 10;
                }
                $('.rating').attr('data-rating', rating);
                $('.rating_car').html(rating)

            });

        });
    });
    $(document).on('shown.bs.modal', '#review-modal', function () {
        var rid = $(this).attr('data-rid');
        var cid = $(this).attr('data-cid');
        var did = $(this).attr('data-did');
        var image = $(this).data('data-img');
        var uname = $(this).data('data-uname');
        if (rid && did) {
            database.collection('items_review').where('orderid', '==', rid).where('driverId', '==', did).get().then((docSnapshot) => {

                var itemReviewDoc = '';
                if (docSnapshot.size) {
                    $("#review-modal").find('.add_review_btn').text('Update Review');

                    itemReviewDoc = docSnapshot.docs[0].data();
                    $("#default_review").find('.rating').attr('data-rating', itemReviewDoc.rating);
                    $("#review-modal").find('#review_comment').val(itemReviewDoc.comment);

                } else {
                    $("#review-modal").find('.add_review_btn').text('Add Review');
                }

            });
        }
    });
    $(document).on('click', '.add-review', function () {
        $("#review-modal").attr('data-rid', $(this).data('rid')).attr('data-cid', $(this).data('cid')).attr('data-did', $(this).data('did')).attr('data-img', $(this).data('img')).attr('data-uname', $(this).data('uname')).modal("show");
        $('.add_review_btn').attr('data-rid', $(this).data('rid')).attr('data-cid', $(this).data('cid')).attr('data-did', $(this).data('did')).attr('data-img', $(this).data('img')).attr('data-uname', $(this).data('uname'));
    });

    $(document).on('hide.bs.modal', '#review-modal', function () {
        $(this).removeAttr('data-rid').removeAttr('data-did').removeAttr('data-did');
        $(this).find("#attribute_review").empty();
        $(this).find('.rating').attr('data-rating', '');
        $(this).find('#review_comment').val('');
        // $(this).find('#uploded_image ul').empty();
    });

    var star = document.querySelectorAll('input');
    for (var i = 0; i < star.length; i++) {
        star[i].addEventListener('click', function () {
            var rating = this.value;
            $('#rating-value').val(rating);
            $("#default_review").find('.rating').attr('data-rating',rating );
        })
    }
    $(".add_review_btn").click(function () {
        console.log(pageloadded);
        pageloadded = 0;
        //console.log(pageloadded);
        var rating = $('#rating-value').val();
        //$(this).css({'opacity': 0.5,'cursor':'default'});
        var pclass = $(this).data('parent');
        var default_review = $('.' + pclass).find('#default_review');
        var attribute_review = $('.' + pclass).find('#attribute_review');
        //var rating = default_review.find('.rating').attr('data-rating');
        //console.log(rating);
        var rating = parseFloat(rating);

        var reviewAttributes = {};
        // var reviewAttributes2 = {};
        // if(attribute_review.children().length > 0){
        // 	attribute_review.find('.rating-block > li').each(function(li){
        // 		var id = $(this).attr('data-id');
        // 		var value = parseInt($(this).attr('data-rating'));
        // 		reviewAttributes[id] = value;
        // 		reviewAttributes2[id] = {'reviewsCount':1,'reviewsSum':value};
        // 	});
        // }
        var userProfile = '';
        var rid = $(this).attr('data-rid');

        var cid = $(this).attr('data-cid');
        var did = $(this).attr('data-did');
        var image = $(this).attr('data-image');
        var uname = $(this).attr('data-uname');
        var comment = $(".review_comment").val();
        var CustomerId = user_uuid;
        var reviewId = database.collection("tmp").doc().id;
        if (typeof image !== 'undefined' && image !== false) {
            userProfile = image;
        }


        database.collection('items_review').where('orderid', '==', rid).where('driverId', '==', did).get().then((docSnapshot) => {
            if (docSnapshot.size) {

                //update existing review

                var itemReviewDoc = docSnapshot.docs[0].data();

                var timeStamp = firebase.firestore.FieldValue.serverTimestamp();
                database.collection('items_review').doc(itemReviewDoc.Id).update({
                    'comment': comment,
                    'rating': rating,
                    'reviewAttributes': reviewAttributes,
                    'uname': uname,
                    'createdAt': timeStamp
                });

                vendor_data = rental_orders.where('id', "==", rid);
                vendor_data.get().then(async function (snapshots) {
                    if (snapshots.docs[0]) {
                        vendor = snapshots.docs[0].data();
                        var reviewsCount = 0;
                        var reviewsSum = 0;
                        if (vendor.reviewsCount != undefined && vendor.reviewsCount != '') {
                            reviewsCount = vendor.reviewsCount;
                            reviewsCount = reviewsCount - 1;
                        }
                        if (vendor.reviewsSum != undefined && vendor.reviewsSum != '') {
                            reviewsSum = vendor.reviewsSum;
                            reviewsSum = reviewsSum - itemReviewDoc.rating;
                        }

                        reviewsCount = reviewsCount + 1;
                        reviewsSum = reviewsSum + rating;
                        console.log(vendor)

                        database.collection('rental_orders').doc(rid).update({
                            'reviewsCount': reviewsCount,
                            'reviewsSum': reviewsSum
                        });
                    }
                });

                database.collection('users').where('id', '==', did).get().then(async function (usersnapshots) {
                    if (usersnapshots.docs.length > 0) {
                        userreviewsSum = 0;
                        userreviewCount = 0;
                        var val = usersnapshots.docs[0].data();
                        if (val.reviewsSum != undefined && val.reviewsSum != '') {
                            userreviewsSum = val.reviewsSum;
                            userreviewsSum = userreviewsSum - itemReviewDoc.rating;
                        }
                        if (val.reviewsCount != undefined && val.reviewsCount != '') {
                            userreviewCount = val.reviewsCount;
                            userreviewCount = userreviewCount - 1;
                        }
                        userreviewCount = userreviewCount + 1;
                        userreviewsSum = userreviewsSum + rating;
                        database.collection('users').doc(did).update({
                            'reviewsCount': userreviewCount,
                            'reviewsSum': userreviewsSum
                        });
                    }
                });


            } else {

                //create new review
                var timeStamp = firebase.firestore.FieldValue.serverTimestamp();
                database.collection('items_review').doc(reviewId).set({
                    'CustomerId': CustomerId,
                    'driverId': did,
                    'Id': reviewId,
                    'comment': comment,
                    'orderid': rid,
                    'rating': rating,
                    'profile': userProfile,
                    'reviewAttributes': reviewAttributes,
                    'uname': uname,
                    'createdAt': timeStamp
                }).then(function (result) {
                    vendor_data = rental_orders.where('id', "==", rid);
                    vendor_data.get().then(async function (snapshots) {
                        if (snapshots.docs[0]) {
                            vendor = snapshots.docs[0].data();
                            var reviewsCount = 0;
                            var reviewsSum = 0;
                            if (vendor.reviewsCount != undefined && vendor.reviewsCount != '') {
                                reviewsCount = vendor.reviewsCount;
                            }
                            if (vendor.reviewsSum != undefined && vendor.reviewsSum != '') {
                                reviewsSum = vendor.reviewsSum;
                            }
                            reviewsCount = reviewsCount + 1;
                            reviewsSum = reviewsSum + rating;
                            database.collection('rental_orders').doc(rid).update({
                                'reviewsCount': reviewsCount,
                                'reviewsSum': reviewsSum
                            });
                        }
                    });
                    database.collection('users').where('id', '==', did).get().then(async function (usersnapshots) {
                        if (usersnapshots.docs.length > 0) {
                            userreviewsSum = 0;
                            userreviewCount = 0;
                            var val = usersnapshots.docs[0].data();
                            if (val.reviewsSum != undefined && val.reviewsSum != '') {
                                userreviewsSum = val.reviewsSum;
                            }
                            if (val.reviewsCount != undefined && val.reviewsCount != '') {
                                userreviewCount = val.reviewsCount;
                            }
                            userreviewCount = userreviewCount + 1;
                            userreviewsSum = userreviewsSum + rating;
                            database.collection('users').doc(did).update({
                                'reviewsCount': userreviewCount,
                                'reviewsSum': userreviewsSum
                            });
                        }
                    });

                });
            }
        });

    })


</script>
