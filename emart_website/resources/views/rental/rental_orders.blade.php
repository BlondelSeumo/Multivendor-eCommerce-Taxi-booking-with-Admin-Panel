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

            <div class="col-md-12 top-nav mb-3">

                <ul class="nav nav-tabsa custom-tabsa border-0 bg-white rounded overflow-hidden shadow-sm p-2 c-t-order"
                    id="myTab" role="tablist">

                    <li class="nav-item" role="presentation">

                        <a class="nav-link border-0 text-dark py-3 active" id="completed-tab" data-toggle="tab"
                           href="#completed" role="tab" aria-controls="completed" aria-selected="true">

                            <i class="feather-check mr-2 text-success mb-0"></i> {{trans('lang.completed')}}</a>

                    </li>

                    <li class="nav-item border-top" role="presentation">

                        <a class="nav-link border-0 text-dark py-3" id="progress-tab" data-toggle="tab" href="#progress"
                           role="tab" aria-controls="progress" aria-selected="false">

                            <i class="feather-clock mr-2 text-warning mb-0"></i> {{trans('lang.on_progress')}}</a>

                    </li>

                    <li class="nav-item border-top" role="presentation">

                        <a class="nav-link border-0 text-dark py-3" id="canceled-tab" data-toggle="tab" href="#canceled"
                           role="tab" aria-controls="canceled" aria-selected="false">

                            <i class="feather-x-circle mr-2 text-danger mb-0"></i> {{trans('lang.canceled')}}</a>

                    </li>

                </ul>

            </div>

            <div class="tab-content col-md-12" id="myTabContent">

                <div class="tab-pane fade show active" id="completed" role="tabpanel" aria-labelledby="completed-tab">

                    <div class="order-body">

                        <div id="completed_orders"></div>


                    </div>

                </div>

                <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">

                    <div class="order-body">

                        <div id="pending_orders"></div>


                    </div>

                </div>

                <div class="tab-pane fade" id="canceled" role="tabpanel" aria-labelledby="canceled-tab">

                    <div class="order-body">

                        <div id="rejected_orders"></div>


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
                                        <!-- <ul class="rating rate_this" data-rating="0" style="color:#eca700 !important">
                                            <li class="rating__item"></li>
                                            <li class="rating__item"></li>
                                            <li class="rating__item"></li>
                                            <li class="rating__item"></li>
                                            <li class="rating__item"></li>
                                          </ul> -->
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
    var rental_orders = database.collection('rental_orders');

    var completedorsersref = database.collection('rental_orders').where("authorID", "==", user_uuid).orderBy('createdAt', 'desc');
    var deliveryCharge = 0;
    var taxSetting = [];
    var reviewUserProfile = '';

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

    var place_holder_image = '';
    var ref_placeholder_image = database.collection('settings').doc("placeHolderImage");
    ref_placeholder_image.get().then(async function (snapshots) {
        var placeHolderImage = snapshots.data();
        place_holder_image = placeHolderImage.image;
    });

    $(document).ready(function () {
        getOrders();

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

    async function getOrders() {


        completedorsersref.get().then(async function (completedorderSnapshots) {

            completed_orders = document.getElementById('completed_orders');

            pending_orders = document.getElementById('pending_orders');

            rejected_orders = document.getElementById('rejected_orders');


            completed_orders.innerHTML = '';

            pending_orders.innerHTML = '';

            rejected_orders.innerHTML = '';


            completedOrderHtml = buildHTMLCompletedOrders(completedorderSnapshots);

            pendingOrderHtml = buildHTMLPendingOrders(completedorderSnapshots);

            rejectedOrdersHtml = buildHTMLRejectedOrders(completedorderSnapshots);


            completed_orders.innerHTML = completedOrderHtml;

            pending_orders.innerHTML = pendingOrderHtml;

            rejected_orders.innerHTML = rejectedOrdersHtml;

        })

    }


    function buildHTMLCompletedOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {


            var val = listval;

            if (val.status == "Order Completed") {
                var order_id = val.id;
                if (val.hasOwnProperty('driver')) {


                    reviewUserProfile = val.author.profilePictureURL;

                    var orderRestaurantImage = '';
                    console.log(val.driver.carInfo.car_image)
                    if (val.driver.carInfo.car_image.length > 0) {
                        orderRestaurantImage = val.driver.carInfo.car_image[0];
                    } else {

                        orderRestaurantImage = place_holder_image;
                    }
                }
                // html = html + '';
                var order_discount = 0;

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = parseFloat(val.discount);
                    }
                }

                order_subtotal = val.subTotal;

                order_subtotal = (parseFloat(order_subtotal) - parseFloat(order_discount));
                if (val.hasOwnProperty('driverRate') && val.driverRate) {

                    var driverRate = parseFloat(val.driverRate);
                    order_subtotal = (parseFloat(order_subtotal) + parseFloat(driverRate));

                }
                tax = 0;
                if (val.hasOwnProperty('taxType')) {
                    if (val.taxType && val.tax) {
                        if (val.taxType == "percent") {
                            tax = (val.tax * order_subtotal) / 100;
                        } else {
                            tax = val.tax;
                        }
                    }
                }


                order_total = order_subtotal + parseFloat(tax);


                var subtotal = '';

                if (currencyAtRight) {
                    order_total_val = order_total.toFixed(decimal_degits) + '' + currentCurrency;
                    // subtotal = order_subtotal+''+currentCurrency;

                } else {
                    order_total_val = currentCurrency + '' + order_total.toFixed(decimal_degits);
                    // subtotal =currentCurrency+''+order_subtotal;

                }

                var rating = 0;
                if (val.driver.reviewsSum && val.driver.reviewsCount) {
                    rating = (val.driver.reviewsSum / val.driver.reviewsCount);

                    rating = Math.round(rating * 10) / 10;
                }
                var passengers = 0;
                if (val.driver.carInfo.passenger && val.driver.carInfo.passenger != null) {
                    passengers = val.driver.carInfo.passenger;
                }
                var gear = "";
                if (val.driver.carInfo.gear && val.driver.carInfo.gear != null) {
                    gear = val.driver.carInfo.gear;
                }
                var gear = "";
                if (val.driver.carInfo.gear && val.driver.carInfo.gear != null) {
                    gear = val.driver.carInfo.gear;
                }
                var fuel_type = "";
                if (val.driver.carInfo.fuel_type && val.driver.carInfo.fuel_type != null) {
                    fuel_type = val.driver.carInfo.fuel_type;
                }
                // if(val.paymentCollectByReceiver == true)
                //    {
                payment = 'Done';
                //    }
                //    else{
                //     payment = 'Pending';
                //    }
                if (val.pickupDateTime._seconds != undefined) {
                    var date = new Date(val.pickupDateTime._seconds * 1000);
                    var pick_up_time = date.toLocaleTimeString('en-US');

                } else {
                    var pick_up_time = val.pickupDateTime.toDate().toLocaleTimeString('en-US');

                }

                if (val.dropDateTime._seconds != undefined) {
                    var date_drop = new Date(val.dropDateTime._seconds * 1000);
                    var drop_off_time = date_drop.toLocaleTimeString('en-US');

                } else {
                    var drop_off_time = val.dropDateTime.toDate().toLocaleTimeString('en-US');

                }
                var id = val.id;
                var route1 = '{{route("rental_orders_detail",":id")}}';
                route1 = route1.replace(':id', id);
                html = html + '<div class="order-rental-list-right"><div class="rentalcar-list bg-white p-3 mb-4"><div class="row"><div class="col-md-2 car-img align-items-center d-flex">';
                html = html + '<img alt="#" src="' + orderRestaurantImage + '" class="img-fluid item-img"></div>';
                html = html + '<div class="col-md-8 car-detail car-det-title"><h3>' + val.driver.carName + ' ' + val.driver.carMakes + '</h3>';
                const ratings = ratings_get(val.driverID);
                html = html + '<div class="ratings"><ul class="rating ' + val.driverID + '" data-rating=""><li class="rating__item"></li></ul><span  class="rate' + val.driverID + '"></span></div>';
                html = html + '<div class="car-feture"><ul><li><img src="../img/user-icon.png">' + passengers + ' {{trans("lang.pessengers")}}</li><li><img src="../img/manual-icon.png">' + gear + '</li><li><img src="../img/fuel-icon.png">' + fuel_type + '</li></ul>';
                html = html + '<div class="col-md-4"><a class="btn btn-outline-primary" href="' + route1 + '">View Details</a>&nbsp<a class="btn btn-primary add-review" data-uname="' + val.author.firstName + '" data-rid="' + val.id + '" data-cid="' + val.authorID + '" data-did="' + val.driverID + '" data-img="' + val.author.profilePictureURL + '" href="javascript:0">Add Review</a></div>';
                html = html + '</div></div>';
                html = html + '<div class="col-md-2 car-price"><span class="price">' + order_total_val + '<small></small></span><span class="car-price-with">{{trans("lang.With_driver_trip")}}</span></div></div>';

                html = html + '<div class="carbook-summary"><div class="row"><div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.pick_up")}}</h3><p><img src="../img/time-icon.png">' + val.pickupDateTime.toDate().toDateString() + ' ' + pick_up_time + '</p><p><img src="../img/bk-location-icon.png">' + val.pickupAddress + '</p></div>';
                html = html + '<div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.drop_off")}}</h3><p><img src="../img/time-icon.png">' + val.dropDateTime.toDate().toDateString() + ' ' + drop_off_time + '</p><p><img src="../img/bk-location-icon.png">' + val.dropAddress + '</p></div>';

                html = html + '<div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.payment")}}</h3><p><img src="../img/done-icon.png">' + payment + '</p></div></div></div></div></div></div></div>';

            }


        });


        return html;

    }


    function buildHTMLPendingOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {

            var val = listval;


            if (val.status == "Order Placed" || val.status == "Order Accepted" || val.status == "Driver Pending" || val.status == "Driver Accepted" || val.status == "Order Shipped" || val.status == "In Transit") {
                var order_id = val.id;

                if (val.hasOwnProperty('driver')) {


                    var orderRestaurantImage = '';
                    if (val.driver.carInfo.car_image.length > 0) {
                        orderRestaurantImage = val.driver.carInfo.car_image[0];
                    } else {

                        orderRestaurantImage = place_holder_image;
                    }
                }
                // html = html + '';
                var order_discount = 0;

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = parseFloat(val.discount);
                    }
                }

                order_subtotal = val.subTotal;

                order_subtotal = (parseFloat(order_subtotal) - parseFloat(order_discount));
                if (val.hasOwnProperty('driverRate') && val.driverRate) {

                    var driverRate = parseFloat(val.driverRate);
                    order_subtotal = (parseFloat(order_subtotal) + parseFloat(driverRate));

                }
                tax = 0;
                if (val.hasOwnProperty('taxType')) {
                    if (val.taxType && val.tax) {
                        if (val.taxType == "percent") {
                            tax = (val.tax * order_subtotal) / 100;
                        } else {
                            tax = val.tax;
                        }
                    }
                }


                order_total = order_subtotal + parseFloat(tax);


                var subtotal = '';

                if (currencyAtRight) {
                    order_total_val = order_total.toFixed(decimal_degits) + '' + currentCurrency;
                    // subtotal = order_subtotal+''+currentCurrency;

                } else {
                    order_total_val = currentCurrency + '' + order_total.toFixed(decimal_degits);
                    // subtotal =currentCurrency+''+order_subtotal;

                }

                var rating = 0;
                if (val.driver.reviewsSum && val.driver.reviewsCount) {
                    rating = (val.driver.reviewsSum / val.driver.reviewsCount);

                    rating = Math.round(rating * 10) / 10;
                }
                var passengers = 0;
                if (val.driver.carInfo.passenger && val.driver.carInfo.passenger != null) {
                    passengers = val.driver.carInfo.passenger;
                }
                var gear = "";
                if (val.driver.carInfo.gear && val.driver.carInfo.gear != null) {
                    gear = val.driver.carInfo.gear;
                }
                var gear = "";
                if (val.driver.carInfo.gear && val.driver.carInfo.gear != null) {
                    gear = val.driver.carInfo.gear;
                }
                var fuel_type = "";
                if (val.driver.carInfo.fuel_type && val.driver.carInfo.fuel_type != null) {
                    fuel_type = val.driver.carInfo.fuel_type;
                }
                // if(val.paymentCollectByReceiver == true)
                //    {
                payment = 'Done';
                //    }
                //    else{
                //     payment = 'Pending';
                //    }
                console.log(val.pickupDateTime)
                if (val.pickupDateTime._seconds != undefined) {
                    var date = new Date(val.pickupDateTime._seconds * 1000);
                    var pick_up_time = date.toLocaleTimeString('en-US');

                } else {
                    var pick_up_time = val.pickupDateTime.toDate().toLocaleTimeString('en-US');

                }

                if (val.dropDateTime._seconds != undefined) {
                    var date_drop = new Date(val.dropDateTime._seconds * 1000);
                    var drop_off_time = date_drop.toLocaleTimeString('en-US');

                } else {
                    var drop_off_time = val.dropDateTime.toDate().toLocaleTimeString('en-US');

                }
                var id = val.id;
                var route1 = '{{route("rental_orders_detail",":id")}}';
                route1 = route1.replace(':id', id);
                html = html + '<div class="order-rental-list-right"><div class="order-rental-list-right"><div class="rentalcar-list bg-white p-3 mb-4"><div class="row"><div class="col-md-2 car-img align-items-center d-flex">';
                html = html + '<img alt="#" src="' + orderRestaurantImage + '" class="img-fluid item-img"></div>';
                html = html + '<div class="col-md-8 car-detail car-det-title"><h3>' + val.driver.carName + ' ' + val.driver.carMakes + '</h3>';
                const ratings = ratings_get(val.driverID);
                html = html + '<div class="ratings"><ul class="rating ' + val.driverID + '" data-rating=""><li class="rating__item"></li></ul><span class="rate' + val.driverID + '"></span></div>';
                html = html + '<div class="car-feture"><ul><li><img src="../img/user-icon.png">' + passengers + ' {{trans("lang.pessengers")}}</li><li><img src="../img/manual-icon.png">' + gear + '</li><li><img src="../img/fuel-icon.png">' + fuel_type + '</li></ul><div class="col-md-4"><a class="btn btn-success" href="' + route1 + '">View Details</a></div></div></div>';
                html = html + '<div class="col-md-2 car-price"><span class="price">' + order_total_val + '<small></small></span><span class="car-price-with">{{trans("lang.With_driver_trip")}}</span></div></div>';
                html = html + '<div class="carbook-summary"><div class="row"><div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.pick_up")}}</h3><p><img src="../img/time-icon.png">' + val.pickupDateTime.toDate().toDateString() + ' ' + pick_up_time + '</p><p><img src="../img/bk-location-icon.png">' + val.pickupAddress + '</p></div>';
                html = html + '<div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.drop_off")}}</h3><p><img src="../img/time-icon.png">' + val.dropDateTime.toDate().toDateString() + ' ' + drop_off_time + '</p><p><img src="../img/bk-location-icon.png">' + val.dropAddress + '</p></div>';


                html = html + '<div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.payment")}}</h3><p><img src="../img/done-icon.png">' + payment + '</p></div></div></div></div></div></div></div></div>';
                //  }
            }


        });


        return html;

    }


    function buildHTMLRejectedOrders(completedorderSnapshots) {

        var html = '';

        var alldata = [];

        var number = [];

        completedorderSnapshots.docs.forEach((listval) => {

            var datas = listval.data();
            datas.id = listval.id;
            alldata.push(datas);

        });


        alldata.forEach((listval) => {

            var val = listval;

            var order_id = val.id;


            if (val.status == "Driver Rejected" || val.status == "Order Rejected") {
                if (val.hasOwnProperty('driver')) {
                    var order_id = val.id;


                    var orderRestaurantImage = '';
                    if (val.driver.carInfo.car_image.length > 0) {
                        orderRestaurantImage = val.driver.carInfo.car_image[0];
                    } else {

                        orderRestaurantImage = place_holder_image;
                    }
                }
                // html = html + '';
                var order_discount = 0;

                if (val.hasOwnProperty('discount') && val.discount) {
                    if (val.discount) {
                        order_discount = parseFloat(val.discount);
                    }
                }

                order_subtotal = val.subTotal;

                order_subtotal = (parseFloat(order_subtotal) - parseFloat(order_discount));
                if (val.hasOwnProperty('driverRate') && val.driverRate) {

                    var driverRate = parseFloat(val.driverRate);
                    order_subtotal = (parseFloat(order_subtotal) + parseFloat(driverRate));

                }
                tax = 0;
                if (val.hasOwnProperty('taxType')) {
                    if (val.taxType && val.tax) {
                        if (val.taxType == "percent") {
                            tax = (val.tax * order_subtotal) / 100;
                        } else {
                            tax = val.tax;
                        }
                    }
                }


                order_total = order_subtotal + parseFloat(tax);


                var subtotal = '';

                if (currencyAtRight) {
                    order_total_val = order_total.toFixed(decimal_degits) + '' + currentCurrency;
                    // subtotal = order_subtotal+''+currentCurrency;

                } else {
                    order_total_val = currentCurrency + '' + order_total.toFixed(decimal_degits);
                    // subtotal =currentCurrency+''+order_subtotal;

                }

                var rating = 0;
                if (val.driver.reviewsSum && val.driver.reviewsCount) {
                    rating = (val.driver.reviewsSum / val.driver.reviewsCount);

                    rating = Math.round(rating * 10) / 10;
                }
                var passengers = 0;
                if (val.driver.carInfo.passenger && val.driver.carInfo.passenger != null) {
                    passengers = val.driver.carInfo.passenger;
                }
                var gear = "";
                if (val.driver.carInfo.gear && val.driver.carInfo.gear != null) {
                    gear = val.driver.carInfo.gear;
                }
                var gear = "";
                if (val.driver.carInfo.gear && val.driver.carInfo.gear != null) {
                    gear = val.driver.carInfo.gear;
                }
                var fuel_type = "";
                if (val.driver.carInfo.fuel_type && val.driver.carInfo.fuel_type != null) {
                    fuel_type = val.driver.carInfo.fuel_type;
                }
                // if(val.paymentCollectByReceiver == true)
                //    {
                payment = 'Done';
                //    }
                //    else{
                //     payment = 'Pending';
                //    }
                console.log(val.pickupDateTime)
                if (val.pickupDateTime._seconds != undefined) {
                    var date = new Date(val.pickupDateTime._seconds * 1000);
                    var pick_up_time = date.toLocaleTimeString('en-US');

                } else {
                    var pick_up_time = val.pickupDateTime.toDate().toLocaleTimeString('en-US');

                }

                if (val.dropDateTime._seconds != undefined) {
                    var date_drop = new Date(val.dropDateTime._seconds * 1000);
                    var drop_off_time = date_drop.toLocaleTimeString('en-US');

                } else {
                    var drop_off_time = val.dropDateTime.toDate().toLocaleTimeString('en-US');

                }
                var id = val.id;
                var route1 = '{{route("rental_orders_detail",":id")}}';
                route1 = route1.replace(':id', id);
                html = html + '<div class="order-rental-list-right"><div class="rentalcar-list bg-white p-3 mb-4"><div class="row"><div class="col-md-2 car-img align-items-center d-flex">';
                html = html + '<img alt="#" src="' + orderRestaurantImage + '" class="img-fluid item-img"></div>';
                html = html + '<div class="col-md-8 car-detail car-det-title"><h3>' + val.driver.carName + ' ' + val.driver.carMakes + '</h3>';
                const ratings = ratings_get(val.driverID);

                html = html + '<div class="ratings"><ul class="rating ' + val.driverID + '" data-rating=""><li class="rating__item"></li></ul><span class="rate' + val.driverID + '"></span></div>';
                html = html + '<div class="car-feture"><ul><li><img src="../img/user-icon.png">' + passengers + ' {{trans("lang.pessengers")}}</li><li><img src="../img/manual-icon.png">' + gear + '</li><li><img src="../img/fuel-icon.png">' + fuel_type + '</li></ul><div class="col-md-4"><a class="btn btn-success" href="' + route1 + '">View Details</a></div></div></div>';
                html = html + '<div class="col-md-2 car-price"><span class="price">' + order_total_val + '<small></small></span><span class="car-price-with">{{trans("lang.With_driver_trip")}}</span></div></div>';
                html = html + '<div class="carbook-summary"><div class="row"><div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.pick_up")}}</h3><p><img src="../img/time-icon.png">' + val.pickupDateTime.toDate().toDateString() + ' ' + pick_up_time + '</p><p><img src="../img/bk-location-icon.png">' + val.pickupAddress + '</p></div>';
                html = html + '<div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.drop_off")}}</h3><p><img src="../img/time-icon.png">' + val.dropDateTime.toDate().toDateString() + ' ' + drop_off_time + '</p><p><img src="../img/bk-location-icon.png">' + val.dropAddress + '</p></div>';

                html = html + '<div class="carbook-summary-box mb-4 col-md-4"><h3>{{trans("lang.payment")}}</h3><p><img src="../img/done-icon.png">' + payment + '</p></div></div></div></div></div></div></div>';
                // }
            }
        });


        return html;

    }

    async function ratings_get(ratings) {
        var ratings_get = '';
        await database.collection('users').where("id", "==", ratings).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {
                var rating_data = snapshotss.docs[0].data();

                var rating = 0;
                if (rating_data.reviewsSum && rating_data.reviewsCount) {
                    rating = (rating_data.reviewsSum / rating_data.reviewsCount);

                    rating = Math.round(rating * 10) / 10;
                }
                console.log(rating)
                jQuery(".rating" + ratings).attr('data-rating', rating);
                jQuery(".rate" + ratings).html(rating);
            } else {
                jQuery(".rating" + ratings).attr('data-rating', 0);
                jQuery(".rate" + ratings).html(rating);
            }
        });
        return ratings_get;
    }


</script>
